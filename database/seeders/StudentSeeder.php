<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->insert([
            ['name'=>'Volkova A. R.', 'email'=>'volkova@gmail.com', 'phone_number'=>'12345678901'],
            ['name'=>'Lyubimov L. G.', 'email'=>'lyubimov@gmail.com', 'phone_number'=>'23456789012'],
            ['name'=>'Kozlova K. P.', 'email'=>'kozlova@gmail.com', 'phone_number'=>'34567890123'],
            ['name'=>'Grigoriev D. P.', 'email'=>'grigoriev@gmail.com', 'phone_number'=>'45678901234'],
            ['name'=>'Popova A. S.', 'email'=>'popova@gmail.com', 'phone_number'=>'56789012345'],
            ['name'=>'Popov A. M.', 'email'=>'popov@gmail.com', 'phone_number'=>'67890123456'],
            ['name'=>'Osipova K. V.', 'email'=>'osipova@gmail.com', 'phone_number'=>'78901234567'],
            ['name'=>'Kuzmin A. M.', 'email'=>'kuzmin@gmail.com', 'phone_number'=>'89012345678'],
            ['name'=>'Sinitsyna M. D.', 'email'=>'sinitsyna@gmail.com', 'phone_number'=>'90123456789'],
            ['name'=>'Mikhailov A. I.', 'email'=>'mikhailov@gmail.com', 'phone_number'=>'01234567890'],
        ]);
    }
}
