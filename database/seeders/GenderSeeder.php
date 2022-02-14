<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['gender_id' => 1, 'gender_desc' => 'Male'],
            ['gender_id' => 2, 'gender_descdesc' => 'Female'],
        ];

        DB::table('genders')->insert($data);
    }
}
