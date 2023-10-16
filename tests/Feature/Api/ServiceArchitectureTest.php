<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ServiceArchitecture;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceArchitectureTest extends TestCase
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
    public function it_gets_service_architectures_list(): void
    {
        $serviceArchitectures = ServiceArchitecture::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.service-architectures.index'));

        $response->assertOk()->assertSee($serviceArchitectures[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_service_architecture(): void
    {
        $data = ServiceArchitecture::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.service-architectures.store'),
            $data
        );

        $this->assertDatabaseHas('service_architectures', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_service_architecture(): void
    {
        $serviceArchitecture = ServiceArchitecture::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->putJson(
            route('api.service-architectures.update', $serviceArchitecture),
            $data
        );

        $data['id'] = $serviceArchitecture->id;

        $this->assertDatabaseHas('service_architectures', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_service_architecture(): void
    {
        $serviceArchitecture = ServiceArchitecture::factory()->create();

        $response = $this->deleteJson(
            route('api.service-architectures.destroy', $serviceArchitecture)
        );

        $this->assertModelMissing($serviceArchitecture);

        $response->assertNoContent();
    }
}
