<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Attendance;
use App\Events\AttendanceScanned;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AttendanceController extends Controller
{
    public function scan(Request $request)
    {
        // Validasi input dari IoT (UID)
        $request->validate([
            'uid' => 'required|string'
        ]);

        // 1. Cari siswa berdasarkan UID
        $student = Student::where('uid', $request->uid)->first();

        if (!$student) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        // 2. Cek apakah sudah presensi hari ini
        $attendance = Attendance::where('student_id', $student->id)
            ->whereDate('date', Carbon::today())
            ->first();

        if ($attendance) {
            return response()->json([
                'message' => 'Anda sudah melakukan presensi hari ini pada jam ' . $attendance->created_at->format('H:i'),
                'already_scanned' => true
            ], 200); // Kita beri 200 agar IoT tidak menganggap error, tapi ada flag khusus
        }

        // 3. Tentukan status (hadir atau telat) jika sebelum/sesudah jam 07:15
        $now = Carbon::now();
        $threshold = Carbon::today()->setTime(7, 15);
        $status = $now->greaterThan($threshold) ? 'telat' : 'hadir';

        // 4. Catat presensi baru (hanya jika belum ada)
        $attendance = Attendance::create([
            'student_id' => $student->id,
            'date' => Carbon::today()->toDateString(),
            'status' => $status
        ]);

        // 5. Pemicu Event Real-time ke Dashboard
        broadcast(new AttendanceScanned($attendance));

        // 6. Kirim Notifikasi Telegram ke Wali Murid
        $this->sendTelegramNotification($attendance);

        return response()->json([
            'message' => $status === 'telat' ? 'Anda Terlambat!' : 'Presensi Berhasil',
            'data' => $attendance->load('student')
        ]);
    }

    protected function sendTelegramNotification($attendance)
    {
        $student = $attendance->student;
        $parent = $student->parent;

        if ($parent && $parent->telegram_id) {
            $statusLabel = strtoupper($attendance->status);
            $time = $attendance->created_at->format('H:i:s');
            $date = \Carbon\Carbon::parse($attendance->date)->isoFormat('LL');

            $message = "🔔 <b>NOTIFIKASI SILS</b> 🔔\n";
            $message .= "---------------------------\n";
            $message .= "Siswa: <b>{$student->name}</b>\n";
            $message .= "Status: <b>{$statusLabel}</b>\n";
            $message .= "Waktu: <b>{$time}</b>\n";
            $message .= "Tanggal: <b>{$date}</b>\n";
            $message .= "---------------------------\n";
            $message .= "<i>Pesan ini dikirim otomatis oleh sistem sekolah.</i>";

            app(\App\Services\TelegramService::class)->sendMessage($parent->telegram_id, $message);
        }
    }
}

