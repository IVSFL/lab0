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
            ['name'=>'Davydov A. M.','speciallity'=>'Программирование',"email"=>'davydov@gmail.com'],
            ['name'=>'Isaev R. Р.','speciallity'=>'Алгоритмы', "email"=>'isaev@gmail.com'],
            ['name'=>'Bezrukov N. R.','speciallity'=>'Веб-разработка', "email"=>'bezrukov@gmail.com'],
            ['name'=>'Stepanova A. A.','speciallity'=>'Базы данных', "email"=>'stepanova@gmail.com'],
            ['name'=>'Yakovlev D. R.','speciallity'=>'Мобильная разработка', "email"=>'yakovlev@gmail.com'],
            ['name'=>'Leonova E. В.','speciallity'=>'Искусственный интеллект', "email"=>'leonova@gmail.com'],
            ['name'=>'Zaitsev D. P.','speciallity'=>'DevOps', "email"=>'zaitsev@gmail.com'],
            ['name'=>'Maksimov M. С.','speciallity'=>'Тестирование ПО', "email"=>'maksimov@gmail.com'],
            ['name'=>'Simonov R. Д.','speciallity'=>'Кибербезопасность', "email"=>'simonov@gmail.com'],
            ['name'=>'Shirokov V. E.','speciallity'=>'Анализ данных', "email"=>'shirokov@gmail.com'],
        ]);
    }
}
