<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\lab2\StudentSearchController;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use App\Http\Middleware\TrimStrings;

Route::get('/students', function(){
  return view('student.index');
});

Route::get('/student_search', function() {
  return view('student_search.index');
});

Route::post('/student/create', [StudentController::class, 'StudentCreate'])->name('student.create');

Route::get('/student/all', [StudentController::class, 'StudentRetrieveAll'])->name('student.all');

Route::get('/student/retrieve/{id}', [StudentController::class, 'StudentRetrieve'])->name('student.retrieve');

Route::post('/student/update/{id}', [StudentController::class, 'StudentUpdate'])->name('student.update');

Route::delete('/student/delete/{id}', [StudentController::class, 'StudentDelete'])->name('student.delete');

Route::post('/student/delete-many', [StudentController::class, 'StudentDeleteMany'])->name('student.deleteMany');

Route::get('/student_search/search', [StudentSearchController::class, 'studentSearch'])->withoutMiddleware([ConvertEmptyStringsToNull::class,
TrimStrings::class]);
