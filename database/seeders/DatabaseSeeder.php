<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        // $this->call(AboutAwardSeeder::class);
        $this->call(AboutClientSeeder::class);
        $this->call(AboutEventSeeder::class);
        $this->call(AboutPeopleSeeder::class);
        // $this->call(ContactCourseSeeder::class);
        // $this->call(ContactDonationSeeder::class);
        // $this->call(ContactFreelanceSeeder::class);
        // $this->call(ContactInvestSeeder::class);
        // $this->call(ContactPartnerSeeder::class);
        // $this->call(ContactServiceSeeder::class);
        $this->call(HomeSeeder::class);
        // $this->call(ServiceArchitectureSeeder::class);
        // $this->call(ServiceBoothDesignSeeder::class);
        // $this->call(ServiceInteriorDesignSeeder::class);
        // $this->call(ServiceInteriorPublicSeeder::class);
        // $this->call(ServiceVirtualOfficeSeeder::class);
        // $this->call(ServiceWeddingDecorationSeeder::class);
        // $this->call(Store3dArchitectureSeeder::class);
        // $this->call(Store3dBoothSeeder::class);
        // $this->call(Store3dFurnitureSeeder::class);
        // $this->call(StoreDecorationSeeder::class);
        // $this->call(StoreFloristSeeder::class);
        // $this->call(StoreFurnitureSeeder::class);
        // $this->call(NewsSeeder::class);
        $this->call(UserSeeder::class);
    }
}
