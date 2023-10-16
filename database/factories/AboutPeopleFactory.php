<?php

namespace Database\Factories;

use App\Models\AboutPeople;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutPeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutPeople::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'jabatan' => $this->faker->text(255),
            'text' => $this->faker->text(),
        ];
    }
}
