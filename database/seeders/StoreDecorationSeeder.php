<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreDecoration;

class StoreDecorationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreDecoration::factory()
            ->count(5)
            ->create();
    }
}
