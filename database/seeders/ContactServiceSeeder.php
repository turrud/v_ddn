<?php

namespace Database\Seeders;

use App\Models\ContactService;
use Illuminate\Database\Seeder;

class ContactServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactService::factory()
            ->count(5)
            ->create();
    }
}
