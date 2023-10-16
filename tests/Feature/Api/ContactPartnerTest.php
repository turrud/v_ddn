<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContactPartner;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactPartnerTest extends TestCase
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
    public function it_gets_contact_partners_list(): void
    {
        $contactPartners = ContactPartner::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contact-partners.index'));

        $response->assertOk()->assertSee($contactPartners[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contact_partner(): void
    {
        $data = ContactPartner::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contact-partners.store'), $data);

        $this->assertDatabaseHas('contact_partners', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.contact-partners.update', $contactPartner),
            $data
        );

        $data['id'] = $contactPartner->id;

        $this->assertDatabaseHas('contact_partners', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_partner(): void
    {
        $contactPartner = ContactPartner::factory()->create();

        $response = $this->deleteJson(
            route('api.contact-partners.destroy', $contactPartner)
        );

        $this->assertModelMissing($contactPartner);

        $response->assertNoContent();
    }
}
