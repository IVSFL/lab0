<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function store(Request $request) {
        $validated = $request -> validate([
            'name'=>'required|string|max:255',
            'speciallity'=>'required|string',
            'email'=>'requiredemail|unique:teacher,email'
        ]);

        Teacher::create($validated);

        return response()->json(['message'=>'Преподователь добавлен']);
    }
}
