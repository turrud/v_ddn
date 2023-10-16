<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store3dArchitecture;

class Store3dArchitectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store3dArchitecture::factory()
            ->count(5)
            ->create();
    }
}
