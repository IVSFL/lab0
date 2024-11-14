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
            ['name'=>'Volkova A. R.', 'email'=>'volkova@gmail.com', 'phone_number'=>'89766543421'],
            ['name'=>'Lyubimov L. G.', 'email'=>'lyubimov@gmail.com', 'phone_number'=>'89767865432'],
            ['name'=>'Kozlova K. P.', 'email'=>'kozlova@gmail.com', 'phone_number'=>'89764567654'],
            ['name'=>'Grigoriev D. P.', 'email'=>'grigoriev@gmail.com', 'phone_number'=>'87650987647'],
            ['name'=>'Popova A. S.', 'email'=>'popova@gmail.com', 'phone_number'=>'87659006541'],
            ['name'=>'Popov A. M.', 'email'=>'popov@gmail.com', 'phone_number'=>'89006556666'],
            ['name'=>'Osipova K. V.', 'email'=>'osipova@gmail.com', 'phone_number'=>'89856574554'],
            ['name'=>'Kuzmin A. M.', 'email'=>'kuzmin@gmail.com', 'phone_number'=>'89012345678'],
            ['name'=>'Sinitsyna M. D.', 'email'=>'sinitsyna@gmail.com', 'phone_number'=>'89856576555'],
            ['name'=>'Mikhailov A. I.', 'email'=>'mikhailov@gmail.com', 'phone_number'=>'89056756453'],
        ]);
    }
}
