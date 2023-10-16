<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Store3dArchitecture;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Store3dArchitectureTest extends TestCase
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
    public function it_gets_store3d_architectures_list(): void
    {
        $store3dArchitectures = Store3dArchitecture::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.store3d-architectures.index'));

        $response->assertOk()->assertSee($store3dArchitectures[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_store3d_architecture(): void
    {
        $data = Store3dArchitecture::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.store3d-architectures.store'),
            $data
        );

        $this->assertDatabaseHas('store3d_architectures', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_store3d_architecture(): void
    {
        $store3dArchitecture = Store3dArchitecture::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'file' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.store3d-architectures.update', $store3dArchitecture),
            $data
        );

        $data['id'] = $store3dArchitecture->id;

        $this->assertDatabaseHas('store3d_architectures', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_store3d_architecture(): void
    {
        $store3dArchitecture = Store3dArchitecture::factory()->create();

        $response = $this->deleteJson(
            route('api.store3d-architectures.destroy', $store3dArchitecture)
        );

        $this->assertModelMissing($store3dArchitecture);

        $response->assertNoContent();
    }
}
