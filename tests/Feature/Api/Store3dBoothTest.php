<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Store3dBooth;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Store3dBoothTest extends TestCase
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
    public function it_gets_store3d_booths_list(): void
    {
        $store3dBooths = Store3dBooth::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.store3d-booths.index'));

        $response->assertOk()->assertSee($store3dBooths[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_store3d_booth(): void
    {
        $data = Store3dBooth::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.store3d-booths.store'), $data);

        $this->assertDatabaseHas('store3d_booths', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_store3d_booth(): void
    {
        $store3dBooth = Store3dBooth::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'file' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.store3d-booths.update', $store3dBooth),
            $data
        );

        $data['id'] = $store3dBooth->id;

        $this->assertDatabaseHas('store3d_booths', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_store3d_booth(): void
    {
        $store3dBooth = Store3dBooth::factory()->create();

        $response = $this->deleteJson(
            route('api.store3d-booths.destroy', $store3dBooth)
        );

        $this->assertModelMissing($store3dBooth);

        $response->assertNoContent();
    }
}
