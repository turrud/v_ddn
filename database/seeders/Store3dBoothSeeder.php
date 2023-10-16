<?php

namespace Database\Seeders;

use App\Models\Store3dBooth;
use Illuminate\Database\Seeder;

class Store3dBoothSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store3dBooth::factory()
            ->count(5)
            ->create();
    }
}
