<?php

namespace Database\Seeders;

use App\Models\ContactInvest;
use Illuminate\Database\Seeder;

class ContactInvestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInvest::factory()
            ->count(5)
            ->create();
    }
}
