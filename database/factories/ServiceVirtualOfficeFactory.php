<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ServiceVirtualOffice;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceVirtualOfficeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceVirtualOffice::class;

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
