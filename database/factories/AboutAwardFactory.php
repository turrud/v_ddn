<?php

namespace Database\Factories;

use App\Models\AboutAward;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutAwardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutAward::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->text(255),
            'award1' => $this->faker->text(255),
            'award2' => $this->faker->text(255),
            'award3' => $this->faker->text(255),
            'award4' => $this->faker->text(255),
            'award5' => $this->faker->text(255),
        ];
    }
}
