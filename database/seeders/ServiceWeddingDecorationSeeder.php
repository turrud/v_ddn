<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceWeddingDecoration;

class ServiceWeddingDecorationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceWeddingDecoration::factory()
            ->count(5)
            ->create();
    }
}
