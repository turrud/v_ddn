<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContactCourse;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactCourseControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_contact_courses(): void
    {
        $contactCourses = ContactCourse::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contact-courses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_courses.index')
            ->assertViewHas('contactCourses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contact_course(): void
    {
        $response = $this->get(route('contact-courses.create'));

        $response->assertOk()->assertViewIs('app.contact_courses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contact_course(): void
    {
        $data = ContactCourse::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contact-courses.store'), $data);

        $this->assertDatabaseHas('contact_courses', $data);

        $contactCourse = ContactCourse::latest('id')->first();

        $response->assertRedirect(
            route('contact-courses.edit', $contactCourse)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contact_course(): void
    {
        $contactCourse = ContactCourse::factory()->create();

        $response = $this->get(route('contact-courses.show', $contactCourse));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_courses.show')
            ->assertViewHas('contactCourse');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contact_course(): void
    {
        $contactCourse = ContactCourse::factory()->create();

        $response = $this->get(route('contact-courses.edit', $contactCourse));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_courses.edit')
            ->assertViewHas('contactCourse');
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

        $response = $this->put(
            route('contact-courses.update', $contactCourse),
            $data
        );

        $data['id'] = $contactCourse->id;

        $this->assertDatabaseHas('contact_courses', $data);

        $response->assertRedirect(
            route('contact-courses.edit', $contactCourse)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_course(): void
    {
        $contactCourse = ContactCourse::factory()->create();

        $response = $this->delete(
            route('contact-courses.destroy', $contactCourse)
        );

        $response->assertRedirect(route('contact-courses.index'));

        $this->assertModelMissing($contactCourse);
    }
}
