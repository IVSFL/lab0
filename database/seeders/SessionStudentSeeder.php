<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('session_student')->insert([
            ['student_id'=>1, 'session_id'=>1],
            ['student_id'=>2, 'session_id'=>1],
            ['student_id'=>3, 'session_id'=>1],
            ['student_id'=>4, 'session_id'=>2],
            ['student_id'=>5, 'session_id'=>2],
            ['student_id'=>6, 'session_id'=>3],
            ['student_id'=>7, 'session_id'=>3],
            ['student_id'=>8, 'session_id'=>4],
            ['student_id'=>9, 'session_id'=>4],
            ['student_id'=>10, 'session_id'=>4],
        ]);
    }
}
