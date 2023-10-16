<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactDonation;

class ContactDonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactDonation::factory()
            ->count(5)
            ->create();
    }
}
