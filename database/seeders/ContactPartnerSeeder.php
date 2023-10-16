<?php

namespace Database\Seeders;

use App\Models\ContactPartner;
use Illuminate\Database\Seeder;

class ContactPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactPartner::factory()
            ->count(5)
            ->create();
    }
}
