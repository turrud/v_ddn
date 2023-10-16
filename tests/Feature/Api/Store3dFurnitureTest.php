<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Store3dFurniture;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Store3dFurnitureTest extends TestCase
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
    public function it_gets_store3d_furnitures_list(): void
    {
        $store3dFurnitures = Store3dFurniture::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.store3d-furnitures.index'));

        $response->assertOk()->assertSee($store3dFurnitures[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_store3d_furniture(): void
    {
        $data = Store3dFurniture::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.store3d-furnitures.store'),
            $data
        );

        $this->assertDatabaseHas('store3d_furnitures', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_store3d_furniture(): void
    {
        $store3dFurniture = Store3dFurniture::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'file' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.store3d-furnitures.update', $store3dFurniture),
            $data
        );

        $data['id'] = $store3dFurniture->id;

        $this->assertDatabaseHas('store3d_furnitures', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_store3d_furniture(): void
    {
        $store3dFurniture = Store3dFurniture::factory()->create();

        $response = $this->deleteJson(
            route('api.store3d-furnitures.destroy', $store3dFurniture)
        );

        $this->assertModelMissing($store3dFurniture);

        $response->assertNoContent();
    }
}
