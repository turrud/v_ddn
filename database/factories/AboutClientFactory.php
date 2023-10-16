<?php

namespace Database\Factories;

use App\Models\AboutClient;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutClient::class;

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
        ];
    }
}
