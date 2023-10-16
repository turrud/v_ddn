<?php

namespace Database\Seeders;

use App\Models\StoreFlorist;
use Illuminate\Database\Seeder;

class StoreFloristSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreFlorist::factory()
            ->count(5)
            ->create();
    }
}
