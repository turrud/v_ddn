<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContactPartner;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactPartnerControllerTest extends TestCase
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
    public function it_displays_index_view_with_contact_partners(): void
    {
        $contactPartners = ContactPartner::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contact-partners.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_partners.index')
            ->assertViewHas('contactPartners');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contact_partner(): void
    {
        $response = $this->get(route('contact-partners.create'));

        $response->assertOk()->assertViewIs('app.contact_partners.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contact_partner(): void
    {
        $data = ContactPartner::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contact-partners.store'), $data);

        $this->assertDatabaseHas('contact_partners', $data);

        $contactPartner = ContactPartner::latest('id')->first();

        $response->assertRedirect(
            route('contact-partners.edit', $contactPartner)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contact_partner(): void
    {
        $contactPartner = ContactPartner::factory()->create();

        $response = $this->get(route('contact-partners.show', $contactPartner));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_partners.show')
            ->assertViewHas('contactPartner');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contact_partner(): void
    {
        $contactPartner = ContactPartner::factory()->create();

        $response = $this->get(route('contact-partners.edit', $contactPartner));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_partners.edit')
            ->assertViewHas('contactPartner');
    }

    /**
     * @test
     */
    public function it_updates_the_contact_partner(): void
    {
        $contactPartner = ContactPartner::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'brand' => $this->faker->text(255),
            'bidang_bisnis' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('contact-partners.update', $contactPartner),
            $data
        );

        $data['id'] = $contactPartner->id;

        $this->assertDatabaseHas('contact_partners', $data);

        $response->assertRedirect(
            route('contact-partners.edit', $contactPartner)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_partner(): void
    {
        $contactPartner = ContactPartner::factory()->create();

        $response = $this->delete(
            route('contact-partners.destroy', $contactPartner)
        );

        $response->assertRedirect(route('contact-partners.index'));

        $this->assertModelMissing($contactPartner);
    }
}
