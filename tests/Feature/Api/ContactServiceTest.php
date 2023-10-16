<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContactService;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactServiceTest extends TestCase
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
    public function it_gets_contact_services_list(): void
    {
        $contactServices = ContactService::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contact-services.index'));

        $response->assertOk()->assertSee($contactServices[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contact_service(): void
    {
        $data = ContactService::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contact-services.store'), $data);

        $this->assertDatabaseHas('contact_services', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.contact-services.update', $contactService),
            $data
        );

        $data['id'] = $contactService->id;

        $this->assertDatabaseHas('contact_services', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_service(): void
    {
        $contactService = ContactService::factory()->create();

        $response = $this->deleteJson(
            route('api.contact-services.destroy', $contactService)
        );

        $this->assertModelMissing($contactService);

        $response->assertNoContent();
    }
}
