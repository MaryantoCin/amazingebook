<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['role_id' => 1, 'role_desc' => 'User'],
            ['role_id' => 2, 'role_desc' => 'Admin'],
        ];

        DB::table('roles')->insert($data);
    }
}
