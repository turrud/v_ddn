<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Store3dFurniture;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Store3dFurnitureControllerTest extends TestCase
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
    public function it_displays_index_view_with_store3d_furnitures(): void
    {
        $store3dFurnitures = Store3dFurniture::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('store3d-furnitures.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_furnitures.index')
            ->assertViewHas('store3dFurnitures');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_store3d_furniture(): void
    {
        $response = $this->get(route('store3d-furnitures.create'));

        $response->assertOk()->assertViewIs('app.store3d_furnitures.create');
    }

    /**
     * @test
     */
    public function it_stores_the_store3d_furniture(): void
    {
        $data = Store3dFurniture::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('store3d-furnitures.store'), $data);

        $this->assertDatabaseHas('store3d_furnitures', $data);

        $store3dFurniture = Store3dFurniture::latest('id')->first();

        $response->assertRedirect(
            route('store3d-furnitures.edit', $store3dFurniture)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_store3d_furniture(): void
    {
        $store3dFurniture = Store3dFurniture::factory()->create();

        $response = $this->get(
            route('store3d-furnitures.show', $store3dFurniture)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_furnitures.show')
            ->assertViewHas('store3dFurniture');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_store3d_furniture(): void
    {
        $store3dFurniture = Store3dFurniture::factory()->create();

        $response = $this->get(
            route('store3d-furnitures.edit', $store3dFurniture)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_furnitures.edit')
            ->assertViewHas('store3dFurniture');
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

        $response = $this->put(
            route('store3d-furnitures.update', $store3dFurniture),
            $data
        );

        $data['id'] = $store3dFurniture->id;

        $this->assertDatabaseHas('store3d_furnitures', $data);

        $response->assertRedirect(
            route('store3d-furnitures.edit', $store3dFurniture)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_store3d_furniture(): void
    {
        $store3dFurniture = Store3dFurniture::factory()->create();

        $response = $this->delete(
            route('store3d-furnitures.destroy', $store3dFurniture)
        );

        $response->assertRedirect(route('store3d-furnitures.index'));

        $this->assertModelMissing($store3dFurniture);
    }
}
