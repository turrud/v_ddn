<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\StoreFlorist;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreFloristControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_store_florists(): void
    {
        $storeFlorists = StoreFlorist::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('store-florists.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.store_florists.index')
            ->assertViewHas('storeFlorists');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_store_florist(): void
    {
        $response = $this->get(route('store-florists.create'));

        $response->assertOk()->assertViewIs('app.store_florists.create');
    }

    /**
     * @test
     */
    public function it_stores_the_store_florist(): void
    {
        $data = StoreFlorist::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('store-florists.store'), $data);

        $this->assertDatabaseHas('store_florists', $data);

        $storeFlorist = StoreFlorist::latest('id')->first();

        $response->assertRedirect(route('store-florists.edit', $storeFlorist));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_store_florist(): void
    {
        $storeFlorist = StoreFlorist::factory()->create();

        $response = $this->get(route('store-florists.show', $storeFlorist));

        $response
            ->assertOk()
            ->assertViewIs('app.store_florists.show')
            ->assertViewHas('storeFlorist');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_store_florist(): void
    {
        $storeFlorist = StoreFlorist::factory()->create();

        $response = $this->get(route('store-florists.edit', $storeFlorist));

        $response
            ->assertOk()
            ->assertViewIs('app.store_florists.edit')
            ->assertViewHas('storeFlorist');
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

        $response = $this->put(
            route('store-florists.update', $storeFlorist),
            $data
        );

        $data['id'] = $storeFlorist->id;

        $this->assertDatabaseHas('store_florists', $data);

        $response->assertRedirect(route('store-florists.edit', $storeFlorist));
    }

    /**
     * @test
     */
    public function it_deletes_the_store_florist(): void
    {
        $storeFlorist = StoreFlorist::factory()->create();

        $response = $this->delete(
            route('store-florists.destroy', $storeFlorist)
        );

        $response->assertRedirect(route('store-florists.index'));

        $this->assertModelMissing($storeFlorist);
    }
}
