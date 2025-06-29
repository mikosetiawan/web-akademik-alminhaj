<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $activeClasses = Schedule::distinct('class')->count();
        
        // Calculate average grade
        $averageGrade = Grade::avg('grade') ?? 0;
        
        // Get student growth (comparing last month vs previous month)
        $currentMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $twoMonthsAgo = Carbon::now()->subMonths(2)->startOfMonth();
        
        $currentMonthStudents = Student::where('created_at', '>=', $currentMonth)->count();
        $lastMonthStudents = Student::whereBetween('created_at', [$lastMonth, $currentMonth])->count();
        $twoMonthsAgoStudents = Student::whereBetween('created_at', [$twoMonthsAgo, $lastMonth])->count();
        
        $studentGrowth = $lastMonthStudents > 0 ? 
            round((($currentMonthStudents - $lastMonthStudents) / $lastMonthStudents) * 100, 1) : 0;
        
        // Get performance data for chart (last 6 months)
        $performanceData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthName = $month->format('M Y');
            
            $avgGrade = Grade::whereMonth('created_at', $month->month)
                           ->whereYear('created_at', $month->year)
                           ->avg('grade') ?? 0;
            
            $performanceData[] = [
                'month' => $monthName,
                'grade' => round($avgGrade, 1)
            ];
        }
        
        // Get class distribution data
        $classDistribution = Schedule::select('class', DB::raw('count(*) as student_count'))
            ->groupBy('class')
            ->get();
        
        // Get recent activities
        $recentActivities = collect();
        
        // Recent grades
        $recentGrades = Grade::with(['student', 'subject'])
            ->latest()
            ->take(2)
            ->get()
            ->map(function ($grade) {
                return [
                    'type' => 'grade',
                    'icon' => 'fas fa-file-alt',
                    'color' => 'blue',
                    'title' => 'Nilai Baru Ditambahkan',
                    'description' => "Nilai {$grade->subject->name} untuk {$grade->student->name}: {$grade->grade}",
                    'time' => $grade->created_at->diffForHumans()
                ];
            });
        
        // Recent students
        $recentStudents = Student::latest()
            ->take(2)
            ->get()
            ->map(function ($student) {
                return [
                    'type' => 'student',
                    'icon' => 'fas fa-user-plus',
                    'color' => 'green',
                    'title' => 'Siswa Baru Terdaftar',
                    'description' => "{$student->name} telah mendaftar sebagai siswa baru",
                    'time' => $student->created_at->diffForHumans()
                ];
            });
        
        // Recent attendance
        $recentAttendance = Attendance::with(['student', 'schedule'])
            ->where('status', 'present')
            ->latest()
            ->take(1)
            ->get()
            ->map(function ($attendance) {
                return [
                    'type' => 'attendance',
                    'icon' => 'fas fa-check',
                    'color' => 'purple',
                    'title' => 'Kehadiran Tercatat',
                    'description' => "{$attendance->student->name} hadir di kelas {$attendance->schedule->class}",
                    'time' => $attendance->created_at->diffForHumans()
                ];
            });
        
        $recentActivities = $recentGrades->concat($recentStudents)->concat($recentAttendance)
            ->sortByDesc('time')
            ->take(4);
        
        // Get today's schedule
        $todaySchedule = Schedule::whereDate('date', Carbon::today())
            ->orderBy('start_time')
            ->take(2)
            ->get();
        
        return view('dashboard', compact(
            'totalStudents',
            'totalTeachers', 
            'activeClasses',
            'averageGrade',
            'studentGrowth',
            'performanceData',
            'classDistribution',
            'recentActivities',
            'todaySchedule'
        ));
    }
}