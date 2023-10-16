<?php

namespace Database\Seeders;

use App\Models\StoreFurniture;
use Illuminate\Database\Seeder;

class StoreFurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreFurniture::factory()
            ->count(5)
            ->create();
    }
}
