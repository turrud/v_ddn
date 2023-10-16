<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContactService;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactServiceControllerTest extends TestCase
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
    public function it_displays_index_view_with_contact_services(): void
    {
        $contactServices = ContactService::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contact-services.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_services.index')
            ->assertViewHas('contactServices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contact_service(): void
    {
        $response = $this->get(route('contact-services.create'));

        $response->assertOk()->assertViewIs('app.contact_services.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contact_service(): void
    {
        $data = ContactService::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contact-services.store'), $data);

        $this->assertDatabaseHas('contact_services', $data);

        $contactService = ContactService::latest('id')->first();

        $response->assertRedirect(
            route('contact-services.edit', $contactService)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contact_service(): void
    {
        $contactService = ContactService::factory()->create();

        $response = $this->get(route('contact-services.show', $contactService));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_services.show')
            ->assertViewHas('contactService');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contact_service(): void
    {
        $contactService = ContactService::factory()->create();

        $response = $this->get(route('contact-services.edit', $contactService));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_services.edit')
            ->assertViewHas('contactService');
    }

    /**
     * @test
     */
    public function it_updates_the_contact_service(): void
    {
        $contactService = ContactService::factory()->create();

        $data = [
            'business_need' => 'design_build',
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->randomNumber(),
            'email' => $this->faker->email(),
            'company_name' => $this->faker->text(255),
            'location' => $this->faker->text(255),
            'luas' => 'below_100m',
            'project_value' => '100_200_juta',
            'info' => $this->faker->text(),
            'rencana_meeting' => $this->faker->dateTime(),
            'rencana_pembayaran' => $this->faker->dateTime(),
        ];

        $response = $this->put(
            route('contact-services.update', $contactService),
            $data
        );

        $data['id'] = $contactService->id;

        $this->assertDatabaseHas('contact_services', $data);

        $response->assertRedirect(
            route('contact-services.edit', $contactService)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_service(): void
    {
        $contactService = ContactService::factory()->create();

        $response = $this->delete(
            route('contact-services.destroy', $contactService)
        );

        $response->assertRedirect(route('contact-services.index'));

        $this->assertModelMissing($contactService);
    }
}
