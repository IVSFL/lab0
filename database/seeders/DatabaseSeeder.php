<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Session;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StudentSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            SessionSeeder::class,
            SessionStudentSeeder::class,
            SessionTeacherSeeder::class
        ]);
    }
}
