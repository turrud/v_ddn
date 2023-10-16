<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ContactPartner;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactPartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactPartner::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'brand' => $this->faker->text(255),
            'bidang_bisnis' => $this->faker->text(255),
        ];
    }
}
