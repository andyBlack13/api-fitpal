<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsScheduleTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_schedule_teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_lesson');
            $table->unsignedInteger('id_teacher')->nullable();
            $table->string('lesson_type')->nullable();
            $table->string('classroom')->nullable();
            $table->dateTime('date_lesson')->nullable();
            $table->timestamp('datetime')->useCurrent();

            $table->foreign('id_lesson')->references('id')->on('lessons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons_schedule_teacher');
    }
}
