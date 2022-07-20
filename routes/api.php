<?php

use App\Http\Controllers\api\LessonController;
use App\Http\Controllers\api\LessonScheduleStudentController;
use App\Http\Controllers\api\LessonScheduleTeacherController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    //Rutas protegidas
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::resource('users', UserController::class);
    Route::get('users-get-teachers', [UserController::class, 'getTeacher']);
    Route::resource('lessons', LessonController::class);
    Route::resource('lessons-schedule-teacher', LessonScheduleTeacherController::class);
    Route::resource('lessons-schedule-student', LessonScheduleStudentController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});