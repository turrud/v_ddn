<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ContactDonation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactDonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactDonation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'text' => $this->faker->text(),
        ];
    }
}
