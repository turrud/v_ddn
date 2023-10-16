<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ContactService;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactService::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'business_need' => 'design_build',
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->randomNumber(),
            'email' => $this->faker->email(),
            'company_name' => $this->faker->text(255),
            'location' => $this->faker->text(255),
            'luas' => 'below_100m',
            'project_value' => '100_200_juta',
            'info' => $this->faker->text(),
            'rencana_meeting' => $this->faker->dateTime(),
            'rencana_pembayaran' => $this->faker->dateTime(),
        ];
    }
}
