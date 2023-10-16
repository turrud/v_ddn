<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceBoothDesign;

class ServiceBoothDesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceBoothDesign::factory()
            ->count(5)
            ->create();
    }
}
