<?php

namespace Database\Seeders;

use App\Models\AboutAward;
use Illuminate\Database\Seeder;

class AboutAwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutAward::factory()
            ->count(5)
            ->create();
    }
}
