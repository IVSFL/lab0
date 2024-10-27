<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->insert([
            ['title' => 'Front-end Development', 'description'=>'Пользовательский интерфейс веб-приложений, интерфейсы, дизайн', 'price' => 5000, 'duration' => 16],
            ['title' => 'Data Science', 'description'=>'Анализ данных, прогнозз и принятие решений с помощью статистики.', 'price' => 8500, 'duration' => 25],
            ['title' => 'Mobile App Development', 'description'=>'Разработка приложений для Android и iOS.', 'price' => 5000, 'duration' => 16],
            ['title' => 'OOP', 'price' => 2500, 'description'=>'Использование объектов которые инкапсулируют данные и методы.', 'duration' => 8],
            ['title' => 'Machine Learning ', 'description'=>'Область ИИ, которая позволяет ПК обучаться на основе данных и улучшать свою производительность', 'price' => 10000, 'duration' => 32],
            ['title' => 'Java Development','description'=>'Разработка на языке Java', 'price' => 5000, 'duration' => 16],
            ['title' => 'C++ Development', 'description'=>'Разработка на языке C++', 'price' => 8500, 'duration' => 25],
            ['title' => 'Python Development', 'description'=>'Разработка на языке Python', 'price' => 3500, 'duration' => 16],
            ['title' => 'Graphic Design', 'description'=>'Создание виртуального контента для передачи информации.', 'price' => 5000, 'duration' => 16],
            ['title' => 'Back-end Development', 'description'=>'Серверная часть приложения, управление логикой, базы данных, запросы.', 'price' => 5000, 'duration' => 16]
        ]);
    }
}
