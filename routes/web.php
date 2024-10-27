<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/course', [CourseController::class, 'store']);
Route::post('/session', [SessionController::class, 'store']);
Route::post('/teacher', [TeacherController::class, 'store']);
Route::post('/student', [StudentController::class, 'store']);
