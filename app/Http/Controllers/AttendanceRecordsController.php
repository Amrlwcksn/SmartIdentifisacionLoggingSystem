<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Events\AttendanceScanned;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceRecordsController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['student.parent']);

        if ($request->has('date') && !empty($request->get('date'))) {
            $query->whereDate('date', $request->get('date'));
        }

        if ($request->has('search') && !empty($request->get('search'))) {
            $search = $request->get('search');
            $query->whereHas('student', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($request->has('export')) {
            return $this->exportCsv($query->get());
        }

        $attendances = $query->latest()->paginate(20);
        return view('attendances.index', compact('attendances'));
    }

    private function exportCsv($data)
    {
        $filename = "rekap-presensi-" . date('Y-m-d-His') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Nama Siswa', 'NIS', 'Kelas', 'Tanggal', 'Waktu Tap', 'Status', 'Wali Murid', 'No. HP'];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->student->name,
                    $row->student->nis,
                    $row->student->class,
                    $row->date,
                    $row->created_at->format('H:i:s'),
                    $row->status,
                    $row->student->parent->name,
                    $row->student->parent->phone,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        return view('attendances.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:hadir,telat,izin,sakit,alpa',
        ]);

        // Check if already exists
        $exists = Attendance::where('student_id', $request->student_id)
            ->whereDate('date', $request->date)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Siswa ini sudah memiliki catatan presensi di tanggal tersebut.');
        }

        $attendance = Attendance::create([
            'student_id' => $request->student_id,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        // Trigger real-time update to dashboard if today
        if ($attendance->date == Carbon::today()->toDateString()) {
            broadcast(new AttendanceScanned($attendance));
            
            // Send Telegram Notification
            $this->sendTelegramNotification($attendance);
        }

        return redirect()->route('attendances.index')->with('success', 'Presensi manual berhasil ditambahkan!');
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
            $message .= "<i>Pesan ini dikirim otomatis oleh sistem sekolah (Input Manual Admin).</i>";

            app(\App\Services\TelegramService::class)->sendMessage($parent->telegram_id, $message);
        }
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Catatan presensi berhasil dihapus!');
    }
}
