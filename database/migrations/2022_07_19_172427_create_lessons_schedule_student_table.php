<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsScheduleStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_schedule_student', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_lesson_schedule_teacher');
            $table->unsignedBigInteger('id_student');
            $table->timestamp('datetime')->useCurrent();

            $table->foreign('id_lesson_schedule_teacher')->references('id')->on('lessons_schedule_teacher');
            $table->foreign('id_student')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons_schedule_student');
    }
}
