<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teacher')->insert([
            ['name'=>'Davydov A. M.','speciality'=>'Программирование',"email"=>'davydov@gmail.com'],
            ['name'=>'Isaev R. Р.','speciality'=>'Алгоритмы', "email"=>'isaev@gmail.com'],
            ['name'=>'Bezrukov N. R.','speciality'=>'Веб-разработка', "email"=>'bezrukov@gmail.com'],
            ['name'=>'Stepanova A. A.','speciality'=>'Базы данных', "email"=>'stepanova@gmail.com'],
            ['name'=>'Yakovlev D. R.','speciality'=>'Мобильная разработка', "email"=>'yakovlev@gmail.com'],
            ['name'=>'Leonova E. В.','speciality'=>'Искусственный интеллект', "email"=>'leonova@gmail.com'],
            ['name'=>'Zaitsev D. P.','speciality'=>'DevOps', "email"=>'zaitsev@gmail.com'],
            ['name'=>'Maksimov M. С.','speciality'=>'Тестирование ПО', "email"=>'maksimov@gmail.com'],
            ['name'=>'Simonov R. Д.','speciality'=>'Кибербезопасность', "email"=>'simonov@gmail.com'],
            ['name'=>'Shirokov V. E.','speciality'=>'Анализ данных', "email"=>'shirokov@gmail.com'],
        ]);
    }
}
