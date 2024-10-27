<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('session_teacher')->insert([
            ['session_id'=>1, 'teacher_id'=>1],
            ['session_id'=>1, 'teacher_id'=>2],
            ['session_id'=>2, 'teacher_id'=>3],
            ['session_id'=>2, 'teacher_id'=>4],
            ['session_id'=>3, 'teacher_id'=>5],
            ['session_id'=>4, 'teacher_id'=>6],
        ]);
    }
}
