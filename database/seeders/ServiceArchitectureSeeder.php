<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceArchitecture;

class ServiceArchitectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceArchitecture::factory()
            ->count(5)
            ->create();
    }
}
