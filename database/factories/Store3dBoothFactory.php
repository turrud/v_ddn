<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Store3dBooth;
use Illuminate\Database\Eloquent\Factories\Factory;

class Store3dBoothFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store3dBooth::class;

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
            'file' => $this->faker->text(255),
        ];
    }
}
