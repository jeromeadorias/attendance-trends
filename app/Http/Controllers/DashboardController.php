<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // --- Cards Data ---

        // Total number of students
        $totalStudents = Student::count();

        // Total number of attendance records
        $attendanceCount = Attendance::count();

        // Attendance count per status (Present, Late, Absent)
        $attendancePerStatus = Attendance::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();
           

        // --- Charts Data ---

        // Attendance trend by date (line chart)
        $attendancePerDay = Attendance::select('date', DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('dashboard', compact(
            'totalStudents',
            'attendanceCount',
            'attendancePerStatus',
            'attendancePerDay'
        ));
    }
}
