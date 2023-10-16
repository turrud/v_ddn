<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AboutClient;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutClientTest extends TestCase
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
    public function it_gets_about_clients_list(): void
    {
        $aboutClients = AboutClient::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.about-clients.index'));

        $response->assertOk()->assertSee($aboutClients[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_about_client(): void
    {
        $data = AboutClient::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.about-clients.store'), $data);

        $this->assertDatabaseHas('about_clients', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_about_client(): void
    {
        $aboutClient = AboutClient::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.about-clients.update', $aboutClient),
            $data
        );

        $data['id'] = $aboutClient->id;

        $this->assertDatabaseHas('about_clients', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_about_client(): void
    {
        $aboutClient = AboutClient::factory()->create();

        $response = $this->deleteJson(
            route('api.about-clients.destroy', $aboutClient)
        );

        $this->assertModelMissing($aboutClient);

        $response->assertNoContent();
    }
}
