<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContactFreelance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFreelanceControllerTest extends TestCase
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
    public function it_displays_index_view_with_contact_freelances(): void
    {
        $contactFreelances = ContactFreelance::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contact-freelances.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_freelances.index')
            ->assertViewHas('contactFreelances');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contact_freelance(): void
    {
        $response = $this->get(route('contact-freelances.create'));

        $response->assertOk()->assertViewIs('app.contact_freelances.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contact_freelance(): void
    {
        $data = ContactFreelance::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contact-freelances.store'), $data);

        $this->assertDatabaseHas('contact_freelances', $data);

        $contactFreelance = ContactFreelance::latest('id')->first();

        $response->assertRedirect(
            route('contact-freelances.edit', $contactFreelance)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contact_freelance(): void
    {
        $contactFreelance = ContactFreelance::factory()->create();

        $response = $this->get(
            route('contact-freelances.show', $contactFreelance)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.contact_freelances.show')
            ->assertViewHas('contactFreelance');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contact_freelance(): void
    {
        $contactFreelance = ContactFreelance::factory()->create();

        $response = $this->get(
            route('contact-freelances.edit', $contactFreelance)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.contact_freelances.edit')
            ->assertViewHas('contactFreelance');
    }

    /**
     * @test
     */
    public function it_updates_the_contact_freelance(): void
    {
        $contactFreelance = ContactFreelance::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'introduce' => $this->faker->text(),
            'file' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('contact-freelances.update', $contactFreelance),
            $data
        );

        $data['id'] = $contactFreelance->id;

        $this->assertDatabaseHas('contact_freelances', $data);

        $response->assertRedirect(
            route('contact-freelances.edit', $contactFreelance)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_freelance(): void
    {
        $contactFreelance = ContactFreelance::factory()->create();

        $response = $this->delete(
            route('contact-freelances.destroy', $contactFreelance)
        );

        $response->assertRedirect(route('contact-freelances.index'));

        $this->assertModelMissing($contactFreelance);
    }
}
