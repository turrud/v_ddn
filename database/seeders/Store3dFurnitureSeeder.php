<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store3dFurniture;

class Store3dFurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store3dFurniture::factory()
            ->count(5)
            ->create();
    }
}
