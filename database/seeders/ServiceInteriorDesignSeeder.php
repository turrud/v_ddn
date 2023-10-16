<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceInteriorDesign;

class ServiceInteriorDesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceInteriorDesign::factory()
            ->count(5)
            ->create();
    }
}
