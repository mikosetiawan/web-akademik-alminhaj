<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('teacher', 'subject', 'students')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $students = Student::all();
        $subjects = Subject::all();
        return view('schedules.create', compact('teachers', 'students', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'classroom' => 'required|string|max:50',
            'students' => 'nullable|array',
            'students.*' => 'exists:students,id',
        ]);

        $schedule = Schedule::create($validated);
        if ($request->has('students')) {
            $schedule->students()->sync($request->input('students'));
        }

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load('teacher', 'students');
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $teachers = Teacher::all();
        $students = Student::all();
        $subjects = Subject::all();
        return view('schedules.edit', compact('schedule', 'teachers', 'students', 'subjects'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'classroom' => 'required|string|max:50',
            'students' => 'nullable|array',
            'students.*' => 'exists:students,id',
        ]);

        $schedule->update($validated);
        $schedule->students()->sync($request->input('students', []));

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->students()->detach();
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully');
    }

    public function getStudents(Schedule $schedule)
    {
        return response()->json($schedule->students);
    }
}