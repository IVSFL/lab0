<?php

namespace App\Http\Controllers\lab2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use App\Http\Middleware\TrimStrings;

class StudentSearchController extends Controller
{
    public function __construct() {
        $this->middleware(ConvertEmptyStringsToNull::class)->except('studentSearch');
        $this->middleware(TrimStrings::class)->except('studentSearch');
    }

  public function studentSearch(Request $request) {
    $limit = max((int)$request->input('limit', 5), 1);
    $offset = max((int)$request->input('offset', 0), 0);
    
    $query = Student::query();

    if($request->has('name') && $request->name) {
        $query->where('name', 'ilike', "%{$request->name}%");
    }
    if($request->has('phone_number') && $request->phone_number) {
        $query->where('phone_number', 'ilike', "%{$request->phone_number}%");
    }
    if($request->has('email') && $request->email) {
        $query->where('email', 'ilike', "%{$request->email}%");
    }

    $total = $query->count();
    $result = $query->skip($offset)->take($limit)->get();

    return response()->json([
        'data' => $result,
        'total' => $total,
        //'total' => $request->name,
        'limit' => $request->input('name'),
        'email' => $request->email,
        'phone' => $request->phone_number,
        'get' => $_GET,
        //'limit' => $limit,
        'offset' => $offset,
    ]);
  }
}

