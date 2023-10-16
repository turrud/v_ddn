<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ServiceInteriorPublic;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceInteriorPublicTest extends TestCase
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
    public function it_gets_service_interior_publics_list(): void
    {
        $serviceInteriorPublics = ServiceInteriorPublic::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.service-interior-publics.index'));

        $response->assertOk()->assertSee($serviceInteriorPublics[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_service_interior_public(): void
    {
        $data = ServiceInteriorPublic::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.service-interior-publics.store'),
            $data
        );

        $this->assertDatabaseHas('service_interior_publics', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_service_interior_public(): void
    {
        $serviceInteriorPublic = ServiceInteriorPublic::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->putJson(
            route(
                'api.service-interior-publics.update',
                $serviceInteriorPublic
            ),
            $data
        );

        $data['id'] = $serviceInteriorPublic->id;

        $this->assertDatabaseHas('service_interior_publics', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_service_interior_public(): void
    {
        $serviceInteriorPublic = ServiceInteriorPublic::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.service-interior-publics.destroy',
                $serviceInteriorPublic
            )
        );

        $this->assertModelMissing($serviceInteriorPublic);

        $response->assertNoContent();
    }
}
