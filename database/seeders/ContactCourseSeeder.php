<?php

namespace Database\Seeders;

use App\Models\ContactCourse;
use Illuminate\Database\Seeder;

class ContactCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactCourse::factory()
            ->count(5)
            ->create();
    }
}
