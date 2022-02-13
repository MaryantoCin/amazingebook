<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(GenderSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(EbookSeeder::class);
    }
}
