<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    public function store(Request $request){
        $validated = $request -> validate([
            'course_id' => 'required',
            'start_date' => 'required|date',
            'end_date'=>'required|after:start_date'
        ]);

        Session::create($validated);

        return response()->json(['message'=>'Сессия успешно добавлена']);
    }
}
