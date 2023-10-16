<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ServiceWeddingDecoration;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceWeddingDecorationTest extends TestCase
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
    public function it_gets_service_wedding_decorations_list(): void
    {
        $serviceWeddingDecorations = ServiceWeddingDecoration::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            route('api.service-wedding-decorations.index')
        );

        $response->assertOk()->assertSee($serviceWeddingDecorations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_service_wedding_decoration(): void
    {
        $data = ServiceWeddingDecoration::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.service-wedding-decorations.store'),
            $data
        );

        $this->assertDatabaseHas('service_wedding_decorations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_service_wedding_decoration(): void
    {
        $serviceWeddingDecoration = ServiceWeddingDecoration::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->putJson(
            route(
                'api.service-wedding-decorations.update',
                $serviceWeddingDecoration
            ),
            $data
        );

        $data['id'] = $serviceWeddingDecoration->id;

        $this->assertDatabaseHas('service_wedding_decorations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_service_wedding_decoration(): void
    {
        $serviceWeddingDecoration = ServiceWeddingDecoration::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.service-wedding-decorations.destroy',
                $serviceWeddingDecoration
            )
        );

        $this->assertModelMissing($serviceWeddingDecoration);

        $response->assertNoContent();
    }
}
