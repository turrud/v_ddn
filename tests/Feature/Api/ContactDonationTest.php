<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContactDonation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactDonationTest extends TestCase
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
    public function it_gets_contact_donations_list(): void
    {
        $contactDonations = ContactDonation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contact-donations.index'));

        $response->assertOk()->assertSee($contactDonations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contact_donation(): void
    {
        $data = ContactDonation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.contact-donations.store'),
            $data
        );

        $this->assertDatabaseHas('contact_donations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.contact-donations.update', $contactDonation),
            $data
        );

        $data['id'] = $contactDonation->id;

        $this->assertDatabaseHas('contact_donations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_donation(): void
    {
        $contactDonation = ContactDonation::factory()->create();

        $response = $this->deleteJson(
            route('api.contact-donations.destroy', $contactDonation)
        );

        $this->assertModelMissing($contactDonation);

        $response->assertNoContent();
    }
}
