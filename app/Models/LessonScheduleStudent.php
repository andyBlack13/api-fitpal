<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonScheduleStudent extends Model
{
    use HasFactory;

    protected $table = 'lessons_schedule_student';

    protected $fillable = [
        'id_lesson_schedule_teacher',
        'id_student',
        'datetime'
    ];

    public $timestamps = false;
}
