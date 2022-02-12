<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'desc' => 'Male'],
            ['id' => 2, 'desc' => 'Female'],
        ];

        DB::table('genders')->insert($data);
    }
}
