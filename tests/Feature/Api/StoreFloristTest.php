<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\StoreFlorist;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreFloristTest extends TestCase
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
    public function it_gets_store_florists_list(): void
    {
        $storeFlorists = StoreFlorist::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.store-florists.index'));

        $response->assertOk()->assertSee($storeFlorists[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_store_florist(): void
    {
        $data = StoreFlorist::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.store-florists.store'), $data);

        $this->assertDatabaseHas('store_florists', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_store_florist(): void
    {
        $storeFlorist = StoreFlorist::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'price' => $this->faker->randomFloat(2, 0, 9999),
        ];

        $response = $this->putJson(
            route('api.store-florists.update', $storeFlorist),
            $data
        );

        $data['id'] = $storeFlorist->id;

        $this->assertDatabaseHas('store_florists', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_store_florist(): void
    {
        $storeFlorist = StoreFlorist::factory()->create();

        $response = $this->deleteJson(
            route('api.store-florists.destroy', $storeFlorist)
        );

        $this->assertModelMissing($storeFlorist);

        $response->assertNoContent();
    }
}
