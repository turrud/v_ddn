<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Store3dBooth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Store3dBoothControllerTest extends TestCase
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
    public function it_displays_index_view_with_store3d_booths(): void
    {
        $store3dBooths = Store3dBooth::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('store3d-booths.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_booths.index')
            ->assertViewHas('store3dBooths');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_store3d_booth(): void
    {
        $response = $this->get(route('store3d-booths.create'));

        $response->assertOk()->assertViewIs('app.store3d_booths.create');
    }

    /**
     * @test
     */
    public function it_stores_the_store3d_booth(): void
    {
        $data = Store3dBooth::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('store3d-booths.store'), $data);

        $this->assertDatabaseHas('store3d_booths', $data);

        $store3dBooth = Store3dBooth::latest('id')->first();

        $response->assertRedirect(route('store3d-booths.edit', $store3dBooth));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_store3d_booth(): void
    {
        $store3dBooth = Store3dBooth::factory()->create();

        $response = $this->get(route('store3d-booths.show', $store3dBooth));

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_booths.show')
            ->assertViewHas('store3dBooth');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_store3d_booth(): void
    {
        $store3dBooth = Store3dBooth::factory()->create();

        $response = $this->get(route('store3d-booths.edit', $store3dBooth));

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_booths.edit')
            ->assertViewHas('store3dBooth');
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

        $response = $this->put(
            route('store3d-booths.update', $store3dBooth),
            $data
        );

        $data['id'] = $store3dBooth->id;

        $this->assertDatabaseHas('store3d_booths', $data);

        $response->assertRedirect(route('store3d-booths.edit', $store3dBooth));
    }

    /**
     * @test
     */
    public function it_deletes_the_store3d_booth(): void
    {
        $store3dBooth = Store3dBooth::factory()->create();

        $response = $this->delete(
            route('store3d-booths.destroy', $store3dBooth)
        );

        $response->assertRedirect(route('store3d-booths.index'));

        $this->assertModelMissing($store3dBooth);
    }
}
