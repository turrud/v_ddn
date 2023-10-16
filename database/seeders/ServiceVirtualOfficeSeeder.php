<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceVirtualOffice;

class ServiceVirtualOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceVirtualOffice::factory()
            ->count(5)
            ->create();
    }
}
