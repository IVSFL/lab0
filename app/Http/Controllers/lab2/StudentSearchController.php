<?php

namespace App\Http\Controllers\lab2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentSearchController extends Controller
{
    public function studentSearch(Request $request) {
        $filters = $request -> input('filters', []);
        $limit = $request -> input('limit', 5);
        $offset = $request -> input('offset', 0);
        

        $query = Student::query();

        foreach($filters as $key => $value) {
            if(!empty(value)) {
                $query->where($key, 'LIKE', "%$value%");
            }
        }

        $result = $query->skip($offset)->take($limit)->get();
        $total = $query -> count();

        return response()->json([
            'data'=>$result,
            'total'=>$total,
            'limit'=>$limit,
            'offset'=>$offset,
        ]);
    }
    
}
