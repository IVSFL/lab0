<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[\S]+.*$/',
            'email' => 'required|email|unique:student,email',
            'phone_number' => 'digits:11|'
        ]);

        Student::create($validated);

        return response()->json(['message'=>'Студент успешно добавлен']);
    }
}
