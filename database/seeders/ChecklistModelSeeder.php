<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChecklistModel;

class ChecklistModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChecklistModel::create([
            'name' => 'Modelo 1',
            'description' => 'Descripción de modelo 1',
            'is_active' => true,
            'instructions' => 'Instrucciones de modelo 1',
        ]);

        ChecklistModel::create([
            'name' => 'Modelo 2',
            'description' => 'Descripción de modelo 2',
            'is_active' => true,
            'instructions' => 'Instrucciones de modelo 2',
        ]);

    }
}
