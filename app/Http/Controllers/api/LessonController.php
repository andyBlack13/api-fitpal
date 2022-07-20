<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //MUESTRA LAS CLASES ACTIVAS
    public function index()
    {
        $lessons = Lesson::where('status', 1)
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
    public function store(Request $request)
    {
        $lesson = new Lesson();

        if($request->has('name')){
            $lesson->name = $request->name;
        }
        if($request->has('description')){
            $lesson->description = $request->description;
        }
        
        $lesson->save();

        return response()->json([
            'resp' => 1,
            'id_lesson' => $lesson->id,
            'message' => 'La clase se ha guardado correctamente'
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
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        if($request->has('name')){
            $lesson->name = $request->name;
        }

        if($request->has('description')){
            $lesson->description = $request->description;
        }

        $lesson->save();

        return response()->json([
            'resp' => 1,
            'id_lesson' => $id,
            'message' => 'La clase se ha actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->status = 0;
        $lesson->update();

        return response()->json([
            'resp' => 1,
            'message' => 'La clase se ha eliminado correctamente'
        ]);
    }
}
