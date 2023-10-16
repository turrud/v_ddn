<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\StoreFlorist;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFloristFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreFlorist::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'price' => $this->faker->randomFloat(2, 0, 9999),
        ];
    }
}
