<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonScheduleStudent;
use Illuminate\Http\Request;

class LessonScheduleStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //MUESTRA LAS CLASES Y HORARIOS DISPONIBLES CON PROFESOR (alumno)
    public function index()
    {
       $lessons = LessonScheduleStudent::join('lessons_schedule_teacher', 'lessons_schedule_teacher.id', '=', 'lessons_schedule_student.id_lesson_schedule_teacher')
            ->join('lessons', 'lessons.id', '=', 'lessons_schedule_teacher.id_lesson')
            ->where('lessons.status', 1)
            ->paginate(10);

        return response()->json([
            'resp' => 1,
            'lessons' => $lessons
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //AGENDAMIENTO
    public function store(Request $request)
    {
        //Agendamiento de la clase por el alumno.
        $lesson_schedule_student = new LessonScheduleStudent();
        $lesson_schedule_student->id_lesson_schedule_teacher = $request->id_lesson_schedule_teacher;
        $lesson_schedule_student->id_student = $request->id_student;

        $lesson_schedule_student->save();

        return response()->json([
            'resp' => 1,
            'id_lesson_schedule_student' => $lesson_schedule_student->id,
            'message' => 'El horario del alumno se guardó correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //ACTUALIZA UNA ASIGNACIÓN DE CLASE
    public function update(Request $request, $id)
    {
        $lesson_schedule_student = LessonScheduleStudent::findOrFail($id);

        if($request->has('id_lesson_schedule_teacher')){
            $lesson_schedule_student->id_lesson_schedule_teacher = $request->id_lesson_schedule_teacher;
        }

        if($request->has('id_student')){
            $lesson_schedule_student->id_student = $request->id_student;
        }

        $lesson_schedule_student->save();

        return response()->json([
            'resp' => 1,
            'id_lesson_schedule_student' => $id,
            'message' => 'El horario del alumno se actualizó correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //ELIMINA UNA ASIGNACIÓN DE CLASE
    public function destroy($id)
    {
        $lesson_schedule_student = LessonScheduleStudent::find($id);
        $lesson_schedule_student->delete();

        return response()->json([
            'resp' => 1,
            'message' => 'El horario del alumno se eliminó correctamente'
        ]);
    }
}
