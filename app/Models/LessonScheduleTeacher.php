<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonScheduleTeacher extends Model
{
    use HasFactory;

    protected $table = 'lessons_schedule_teacher';

    protected $fillable = [
        'id_lesson',
        'id_teacher',
        'lesson_type',
        'classroom',
        'date_lesson',
        'datetime'
    ];

    public $timestamps = false;
}
