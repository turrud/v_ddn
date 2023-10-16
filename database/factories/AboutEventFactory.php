<?php

namespace Database\Factories;

use App\Models\AboutEvent;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'tanggal' => $this->faker->text(255),
            'lokasi' => $this->faker->text(255),
        ];
    }
}
