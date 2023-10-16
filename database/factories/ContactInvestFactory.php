<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ContactInvest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactInvestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactInvest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'instansi' => $this->faker->text(255),
        ];
    }
}
