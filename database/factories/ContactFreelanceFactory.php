<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ContactFreelance;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFreelanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactFreelance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'introduce' => $this->faker->text(),
            'file' => $this->faker->text(255),
        ];
    }
}
