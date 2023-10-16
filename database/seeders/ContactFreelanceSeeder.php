<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactFreelance;

class ContactFreelanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactFreelance::factory()
            ->count(5)
            ->create();
    }
}
