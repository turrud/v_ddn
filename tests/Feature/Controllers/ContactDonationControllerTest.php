<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContactDonation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactDonationControllerTest extends TestCase
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
    public function it_displays_index_view_with_contact_donations(): void
    {
        $contactDonations = ContactDonation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contact-donations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_donations.index')
            ->assertViewHas('contactDonations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contact_donation(): void
    {
        $response = $this->get(route('contact-donations.create'));

        $response->assertOk()->assertViewIs('app.contact_donations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contact_donation(): void
    {
        $data = ContactDonation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contact-donations.store'), $data);

        $this->assertDatabaseHas('contact_donations', $data);

        $contactDonation = ContactDonation::latest('id')->first();

        $response->assertRedirect(
            route('contact-donations.edit', $contactDonation)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contact_donation(): void
    {
        $contactDonation = ContactDonation::factory()->create();

        $response = $this->get(
            route('contact-donations.show', $contactDonation)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.contact_donations.show')
            ->assertViewHas('contactDonation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contact_donation(): void
    {
        $contactDonation = ContactDonation::factory()->create();

        $response = $this->get(
            route('contact-donations.edit', $contactDonation)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.contact_donations.edit')
            ->assertViewHas('contactDonation');
    }

    /**
     * @test
     */
    public function it_updates_the_contact_donation(): void
    {
        $contactDonation = ContactDonation::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'text' => $this->faker->text(),
        ];

        $response = $this->put(
            route('contact-donations.update', $contactDonation),
            $data
        );

        $data['id'] = $contactDonation->id;

        $this->assertDatabaseHas('contact_donations', $data);

        $response->assertRedirect(
            route('contact-donations.edit', $contactDonation)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_donation(): void
    {
        $contactDonation = ContactDonation::factory()->create();

        $response = $this->delete(
            route('contact-donations.destroy', $contactDonation)
        );

        $response->assertRedirect(route('contact-donations.index'));

        $this->assertModelMissing($contactDonation);
    }
}
