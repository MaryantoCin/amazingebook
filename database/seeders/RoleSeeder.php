<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'desc' => 'User'],
            ['id' => 2, 'desc' => 'Admin'],
        ];

        DB::table('roles')->insert($data);
    }
}
