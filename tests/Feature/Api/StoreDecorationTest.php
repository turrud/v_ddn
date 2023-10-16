<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\StoreDecoration;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreDecorationTest extends TestCase
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
    public function it_gets_store_decorations_list(): void
    {
        $storeDecorations = StoreDecoration::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.store-decorations.index'));

        $response->assertOk()->assertSee($storeDecorations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_store_decoration(): void
    {
        $data = StoreDecoration::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.store-decorations.store'),
            $data
        );

        $this->assertDatabaseHas('store_decorations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_store_decoration(): void
    {
        $storeDecoration = StoreDecoration::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'price' => $this->faker->randomFloat(2, 0, 9999),
        ];

        $response = $this->putJson(
            route('api.store-decorations.update', $storeDecoration),
            $data
        );

        $data['id'] = $storeDecoration->id;

        $this->assertDatabaseHas('store_decorations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_store_decoration(): void
    {
        $storeDecoration = StoreDecoration::factory()->create();

        $response = $this->deleteJson(
            route('api.store-decorations.destroy', $storeDecoration)
        );

        $this->assertModelMissing($storeDecoration);

        $response->assertNoContent();
    }
}
