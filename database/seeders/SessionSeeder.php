<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('session')->insert([
            ['course_id'=>1, 'start_date'=>'2024-01-10', 'end_date'=>'2024-02-10'],
            ['course_id'=>2, 'start_date'=>'2023-01-10', 'end_date'=>'2024-02-10'],
            ['course_id'=>3, 'start_date'=>'2024-01-10', 'end_date'=>'2025-02-10'],
            ['course_id'=>4, 'start_date'=>'2024-01-10', 'end_date'=>'2024-02-10'],
        ]);
    }
}
