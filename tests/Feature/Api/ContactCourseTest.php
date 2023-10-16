<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContactCourse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactCourseTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_contact_courses_list(): void
    {
        $contactCourses = ContactCourse::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contact-courses.index'));

        $response->assertOk()->assertSee($contactCourses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contact_course(): void
    {
        $data = ContactCourse::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contact-courses.store'), $data);

        $this->assertDatabaseHas('contact_courses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_contact_course(): void
    {
        $contactCourse = ContactCourse::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'university' => $this->faker->text(255),
            'major' => $this->faker->text(255),
            'select_one' => 'senin_selasa',
            'time' => '00.19_end',
        ];

        $response = $this->putJson(
            route('api.contact-courses.update', $contactCourse),
            $data
        );

        $data['id'] = $contactCourse->id;

        $this->assertDatabaseHas('contact_courses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_course(): void
    {
        $contactCourse = ContactCourse::factory()->create();

        $response = $this->deleteJson(
            route('api.contact-courses.destroy', $contactCourse)
        );

        $this->assertModelMissing($contactCourse);

        $response->assertNoContent();
    }
}
