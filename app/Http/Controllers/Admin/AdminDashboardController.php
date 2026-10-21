<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\QrLocation;
use App\Models\Student;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Student::count();
        $totalKelas = ClassRoom::count();
        $totalLokasi = QrLocation::where('is_active', true)->count();
        $absenHariIni = Attendance::whereDate('attendance_date', today())->count();

        $recentAttendances = Attendance::with(['student', 'qrLocation'])
            ->whereDate('attendance_date', today())
            ->latest('attendance_time')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalKelas',
            'totalLokasi',
            'absenHariIni',
            'recentAttendances'
        ));
    }
}
