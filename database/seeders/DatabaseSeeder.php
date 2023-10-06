<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* $this->call(RoleSeeder::class); */
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ChecklistModelSeeder::class);
        $this->call(ElementModelSeeder::class);
    }
}
