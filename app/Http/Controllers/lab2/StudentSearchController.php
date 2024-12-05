<?php

namespace App\Http\Controllers\lab2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentSearchController extends Controller
{
  public function studentSearch(Request $request) {
    $filters = $request->input('filters', []);
    $limit = $request->input('limit', 5);
    $offset = $request->input('offset', 0);
    
    $query = Student::query();

    foreach ($filters as $key => $value) {
        if (!empty($value)) {
            if ($key === 'phone_number') {
                $value = preg_replace('/\D/', '', $value);
            }
            $query->where($key, 'LIKE', "%$value%");
        }
    }

    $total = $query->count();
    $result = $query->skip($offset)->take($limit)->get();

    return response()->json([
        'data' => $result,
        'total' => $total,
        'limit' => $limit,
        'offset' => $offset,
    ]);
  }
}
