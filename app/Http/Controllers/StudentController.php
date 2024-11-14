<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\CreateStudentRequest;
class StudentController extends Controller
{
    /**
     * Создание нового студента
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function StudentCreate(CreateStudentRequest $request) {
      dd($request);
      $student = Student::create([
        'name'=>$request->input('name'),
        'email'=>$request->input('email'),
        'phone_number'=>$request->input('phone_number')
      ]);

      

      return response()->json($student, 201);
    }

    /**
     * Получение всех записей о студентах
     * @return \Illuminate\Http\JsonResponse
     */

     public function StudentRetrieveAll(){
      $student = Student::all();
      return response()->json($student, 200);
     }

     /**
      * Получить студента по првичному ключу
      * @param int $id
      * @return \Illuminate\Http\JsonResponse
      */

      public function StudentRetrieve($id){
        $student = Student::findOrFail($id);
        return response()->json($student, 200);
      }

      /**
       * Обновление данных о студенте по первичному ключу
       * @param Request $request
       * @param int $id
       * @return \Illuminate\Http\JsonResponse
       */

       public function StudentUpdate(Request $request, $id) {
        $student = Student::findOrFail($id);
        $student->update([
          'name'=>$request->input('name'),
          'email'=>$request->input('email'),
          'phone_number'=>$request->input('phone_number')
        ]);

        return response()->json($student, 200);
       }

       /**
        * Удаление студента по первичному ключу
        * @param int $id
        * @return \Illuminate\Http\JsonResponse
        */

        public function StudentDelete(int $id) {
          $student = Student::findOrFail($id);
          $student->delete();

          return response()->json(['message'=>'Student deleted'], 200);
        }

        /**
         * Удаление нескольких записей по первичным ключам
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         */

         public function StudentDeleteMany(Request $request) {
          $ids = $request->input('ids');
          Student::whereIn('id', $ids)->delete();

          return response()->json(['message' => 'Students deleted'], 200);
         }
}
