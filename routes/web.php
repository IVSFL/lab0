<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/students', function(){
  return view('student.index');
});

Route::post('/student/create', [StudentController::class, 'StudentCreate'])->name('student.create');

Route::get('/student/all', [StudentController::class, 'StudentRetrieveAll'])->name('student.all');

Route::get('/student/{id}', [StudentController::class, 'StudentRetrieve'])->name('student.retrieve');

Route::post('/student/{id}/update', [StudentController::class, 'StudentUpdate'])->name('student.update');

Route::delete('/student/{id}', [StudentController::class, 'StudentDelete'])->name('student.delete');

Route::post('/student/delete-many', [StudentController::class, 'StudentDeleteMany'])->name('student.deleteMany');


