<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonScheduleTeacher;
use App\Models\User;
use Illuminate\Http\Request;

class LessonScheduleTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //MUESTRA LAS CLASES Y HORARIOS DISPONIBLES 8 DIAS DESPUES
    public function index()
    {
        //Lecciones creadas disponibles para tomar
        $now = date("Y-m-d H:i:s'", strtotime(now()."+ 8 days"));

        $lessons = Lesson::select('lessons.*',  'lessons_schedule_teacher.*')
            ->join('lessons_schedule_teacher', 'lessons_schedule_teacher.id_lesson', '=', 'lessons.id')
            ->where('lessons_schedule_teacher.date_lesson', '>=', $now)
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

    //CREA UNA CLASE CON HORARIO Y PROFESOR
    public function store(Request $request)
    {
        //Agendamiento de la clase por el profesor o admin.
        $lesson_schedule_teacher = new LessonScheduleTeacher();
        $lesson_schedule_teacher->id_lesson  = $request->id_lesson;

        if($request->has('id_teacher')){
            $lesson_schedule_teacher->id_teacher = $request->id_teacher;
        }

        if($request->has('lesson_type')){
            $lesson_schedule_teacher->lesson_type  = $request->lesson_type;
        }

        if($request->has('classroom')){
            $lesson_schedule_teacher->classroom = $request->classroom;
        }

        if($request->has('date_lesson')){
            $lesson_schedule_teacher->date_lesson = $request->date_lesson;
        }
        
        $lesson_schedule_teacher->save();

        return response()->json([
            'resp' => 1,
            'id_lesson_schedule_teacher' => $lesson_schedule_teacher->id,
            'message' => 'El horario del profesor se ha guardado correctamente'
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

    //ACTUALIZA UNA CLASE CON HORARIO DEL PROFESOR
    public function update(Request $request, $id)
    {
        $lesson_schedule_teacher = LessonScheduleTeacher::findOrFail($id);

        if($request->has('id_lesson')){
            $lesson_schedule_teacher->id_lesson  = $request->id_lesson;
        }

        if($request->has('id_teacher')){
            $lesson_schedule_teacher->id_teacher = $request->id_teacher;
        }

        if($request->has('lesson_type')){
            $lesson_schedule_teacher->lesson_type  = $request->lesson_type;
        }

        if($request->has('classroom')){
            $lesson_schedule_teacher->classroom = $request->classroom;
        }

        if($request->has('date_lesson')){
            $lesson_schedule_teacher->date_lesson = $request->date_lesson;
        }
        
        $lesson_schedule_teacher->save();

        return response()->json([
            'resp' => 1,
            'id_lesson_schedule_teacher' => $id,
            'message' => 'El horario del profesor se actualizó correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //ELIMINA UNA CLASE CON HORARIO
    public function destroy($id)
    {
        $lesson_schedule_teacher = LessonScheduleTeacher::find($id);
        $lesson_schedule_teacher->delete();

        return response()->json([
            'resp' => 1,
            'message' => 'El horario del profesor se eliminó correctamente'
        ]);
    }
}
