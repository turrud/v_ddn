<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ContactCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactCourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactCourse::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'university' => $this->faker->text(255),
            'major' => $this->faker->text(255),
            'select_one' => 'senin_selasa',
            'time' => '00.19_end',
        ];
    }
}
