<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Update dashboard route to use controller
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management Routes
    Route::resource('users', UserController::class);
    
    // Student Routes
    Route::resource('students', StudentController::class);
    
    // Teacher Routes
    Route::resource('teachers', TeacherController::class);
    
    // Attendance Routes
    Route::resource('attendances', AttendanceController::class);
    
    // Grade Routes
    Route::resource('grades', GradeController::class);
    
    // Subject Routes
    Route::resource('subjects', SubjectController::class);
    
    // Schedule Routes
    Route::resource('schedules', ScheduleController::class);
    
    // New Route to get students for a schedule
    Route::get('/schedules/{schedule}/students', [ScheduleController::class, 'getStudents'])->name('schedules.students');
});

require __DIR__.'/auth.php';