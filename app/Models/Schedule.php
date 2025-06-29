<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id', // Change from 'subject' to 'subject_id'
        'day',
        'start_time',
        'end_time',
        'classroom'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class); // Add relationship to Subject
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_schedules');
    }
}