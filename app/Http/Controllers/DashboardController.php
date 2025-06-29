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
        $totalSubjects = Subject::count();
        $activeClasses = Student::distinct('class')->count('class');
        
        // Calculate average grade (using 'score' field instead of 'grade')
        $averageGrade = Grade::avg('score') ?? 0;
        
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
                           ->avg('score') ?? 0;
            
            $performanceData[] = [
                'month' => $monthName,
                'grade' => round($avgGrade, 1)
            ];
        }
        
        // Get class distribution data (using Student's class field)
        $classDistribution = Student::select('class', DB::raw('count(*) as student_count'))
            ->whereNotNull('class')
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
                    'description' => "Nilai {$grade->subject->name} untuk {$grade->student->name}: {$grade->score}",
                    'time' => $grade->created_at->diffForHumans(),
                    'created_at' => $grade->created_at
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
                    'description' => "{$student->name} (NIS: {$student->nis}) telah mendaftar di kelas {$student->class}",
                    'time' => $student->created_at->diffForHumans(),
                    'created_at' => $student->created_at
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
                    'description' => "{$attendance->student->name} hadir pada {$attendance->date}",
                    'time' => $attendance->created_at->diffForHumans(),
                    'created_at' => $attendance->created_at
                ];
            });
        
        $recentActivities = $recentGrades->concat($recentStudents)->concat($recentAttendance)
            ->sortByDesc('created_at')
            ->take(4)
            ->values();
        
        // Get today's schedule (using 'day' field and current day)
        $today = Carbon::now()->format('l'); // Gets full day name like 'Monday'
        $todaySchedule = Schedule::with(['teacher', 'subject'])
            ->where('day', $today)
            ->orderBy('start_time')
            ->take(5)
            ->get();
        
        // Get attendance rate
        $totalAttendanceRecords = Attendance::whereDate('date', '>=', Carbon::now()->subDays(30))->count();
        $presentRecords = Attendance::where('status', 'present')
            ->whereDate('date', '>=', Carbon::now()->subDays(30))
            ->count();
        
        $attendanceRate = $totalAttendanceRecords > 0 ? 
            round(($presentRecords / $totalAttendanceRecords) * 100, 1) : 0;
        
        return view('dashboard', compact(
            'totalStudents',
            'totalTeachers', 
            'totalSubjects',
            'activeClasses',
            'averageGrade',
            'studentGrowth',
            'performanceData',
            'classDistribution',
            'recentActivities',
            'todaySchedule',
            'attendanceRate'
        ));
    }
}