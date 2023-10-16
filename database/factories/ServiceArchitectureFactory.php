<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ServiceArchitecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceArchitectureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceArchitecture::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];
    }
}
