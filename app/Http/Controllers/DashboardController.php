<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        
        // Load only necessary data for the feed
        $attendances = Attendance::with(['student.parent'])
            ->whereDate('date', $today)
            ->latest()
            ->limit(15)
            ->get();

        $totalStudents = Student::count();
        
        // Get student counts by category
        $presentIds = Attendance::whereDate('date', $today)
            ->whereIn('status', ['hadir', 'telat'])
            ->distinct()
            ->pluck('student_id')
            ->toArray();

        $absentIds = Attendance::whereDate('date', $today)
            ->whereIn('status', ['izin', 'sakit', 'alpa'])
            ->distinct()
            ->pluck('student_id')
            ->toArray();

        $scannedStudentIds = array_merge($presentIds, $absentIds);
        $presentToday = count($presentIds);
        $absentToday = $totalStudents - count($scannedStudentIds); // This means "Belum Absen" (No Record)


        return view('dashboard', compact(
            'attendances', 
            'totalStudents', 
            'presentToday', 
            'absentToday', 
            'scannedStudentIds'
        ));
    }
}