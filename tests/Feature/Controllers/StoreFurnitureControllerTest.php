<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\StoreFurniture;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreFurnitureControllerTest extends TestCase
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
    public function it_displays_index_view_with_store_furnitures(): void
    {
        $storeFurnitures = StoreFurniture::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('store-furnitures.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.store_furnitures.index')
            ->assertViewHas('storeFurnitures');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_store_furniture(): void
    {
        $response = $this->get(route('store-furnitures.create'));

        $response->assertOk()->assertViewIs('app.store_furnitures.create');
    }

    /**
     * @test
     */
    public function it_stores_the_store_furniture(): void
    {
        $data = StoreFurniture::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('store-furnitures.store'), $data);

        $this->assertDatabaseHas('store_furnitures', $data);

        $storeFurniture = StoreFurniture::latest('id')->first();

        $response->assertRedirect(
            route('store-furnitures.edit', $storeFurniture)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_store_furniture(): void
    {
        $storeFurniture = StoreFurniture::factory()->create();

        $response = $this->get(route('store-furnitures.show', $storeFurniture));

        $response
            ->assertOk()
            ->assertViewIs('app.store_furnitures.show')
            ->assertViewHas('storeFurniture');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_store_furniture(): void
    {
        $storeFurniture = StoreFurniture::factory()->create();

        $response = $this->get(route('store-furnitures.edit', $storeFurniture));

        $response
            ->assertOk()
            ->assertViewIs('app.store_furnitures.edit')
            ->assertViewHas('storeFurniture');
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

        $response = $this->put(
            route('store-furnitures.update', $storeFurniture),
            $data
        );

        $data['id'] = $storeFurniture->id;

        $this->assertDatabaseHas('store_furnitures', $data);

        $response->assertRedirect(
            route('store-furnitures.edit', $storeFurniture)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_store_furniture(): void
    {
        $storeFurniture = StoreFurniture::factory()->create();

        $response = $this->delete(
            route('store-furnitures.destroy', $storeFurniture)
        );

        $response->assertRedirect(route('store-furnitures.index'));

        $this->assertModelMissing($storeFurniture);
    }
}
