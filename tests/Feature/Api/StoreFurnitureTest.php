<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\StoreFurniture;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreFurnitureTest extends TestCase
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
    public function it_gets_store_furnitures_list(): void
    {
        $storeFurnitures = StoreFurniture::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.store-furnitures.index'));

        $response->assertOk()->assertSee($storeFurnitures[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_store_furniture(): void
    {
        $data = StoreFurniture::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.store-furnitures.store'), $data);

        $this->assertDatabaseHas('store_furnitures', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_store_furniture(): void
    {
        $storeFurniture = StoreFurniture::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'file' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.store-furnitures.update', $storeFurniture),
            $data
        );

        $data['id'] = $storeFurniture->id;

        $this->assertDatabaseHas('store_furnitures', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_store_furniture(): void
    {
        $storeFurniture = StoreFurniture::factory()->create();

        $response = $this->deleteJson(
            route('api.store-furnitures.destroy', $storeFurniture)
        );

        $this->assertModelMissing($storeFurniture);

        $response->assertNoContent();
    }
}
