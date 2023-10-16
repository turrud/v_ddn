<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\StoreDecoration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreDecorationControllerTest extends TestCase
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
    public function it_displays_index_view_with_store_decorations(): void
    {
        $storeDecorations = StoreDecoration::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('store-decorations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.store_decorations.index')
            ->assertViewHas('storeDecorations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_store_decoration(): void
    {
        $response = $this->get(route('store-decorations.create'));

        $response->assertOk()->assertViewIs('app.store_decorations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_store_decoration(): void
    {
        $data = StoreDecoration::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('store-decorations.store'), $data);

        $this->assertDatabaseHas('store_decorations', $data);

        $storeDecoration = StoreDecoration::latest('id')->first();

        $response->assertRedirect(
            route('store-decorations.edit', $storeDecoration)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_store_decoration(): void
    {
        $storeDecoration = StoreDecoration::factory()->create();

        $response = $this->get(
            route('store-decorations.show', $storeDecoration)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.store_decorations.show')
            ->assertViewHas('storeDecoration');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_store_decoration(): void
    {
        $storeDecoration = StoreDecoration::factory()->create();

        $response = $this->get(
            route('store-decorations.edit', $storeDecoration)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.store_decorations.edit')
            ->assertViewHas('storeDecoration');
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

        $response = $this->put(
            route('store-decorations.update', $storeDecoration),
            $data
        );

        $data['id'] = $storeDecoration->id;

        $this->assertDatabaseHas('store_decorations', $data);

        $response->assertRedirect(
            route('store-decorations.edit', $storeDecoration)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_store_decoration(): void
    {
        $storeDecoration = StoreDecoration::factory()->create();

        $response = $this->delete(
            route('store-decorations.destroy', $storeDecoration)
        );

        $response->assertRedirect(route('store-decorations.index'));

        $this->assertModelMissing($storeDecoration);
    }
}
