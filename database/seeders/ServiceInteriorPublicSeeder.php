<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceInteriorPublic;

class ServiceInteriorPublicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceInteriorPublic::factory()
            ->count(5)
            ->create();
    }
}
