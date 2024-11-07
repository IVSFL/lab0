<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/students', function(){
  return view('student.index');
});

// Маршрут для создания студента
Route::post('/student/create', [StudentController::class, 'StudentCreate'])->name('student.create');

// Маршрут для получения всех студентов
Route::get('/student/all', [StudentController::class, 'StudentRetrieveAll'])->name('student.all');

// Маршрут для получения одного студента по ID
Route::get('/student/{id}', [StudentController::class, 'StudentRetrieve'])->name('student.retrieve');

// Маршрут для обновления студента
Route::post('/student/{id}/update', [StudentController::class, 'StudentUpdate'])->name('student.update');

// Маршрут для удаления одного студента
Route::delete('/student/{id}', [StudentController::class, 'StudentDelete'])->name('student.delete');

// Маршрут для удаления нескольких студентов
Route::post('/student/delete-many', [StudentController::class, 'StudentDeleteMany'])->name('student.deleteMany');


