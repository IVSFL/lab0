<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function store(Request $request) {
        $validated = $request -> validate([
            'title'=>'required|string|max:255|alpha_num',
            'description'=>'required',
            'price'=>'required',
            'duration'=>'required'
        ]);

        Course::create($validated);

        return response()->json(['message'=>'Курс добавлен']);
    }
}
