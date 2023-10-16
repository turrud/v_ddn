<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Store3dArchitecture;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Store3dArchitectureControllerTest extends TestCase
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
    public function it_displays_index_view_with_store3d_architectures(): void
    {
        $store3dArchitectures = Store3dArchitecture::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('store3d-architectures.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_architectures.index')
            ->assertViewHas('store3dArchitectures');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_store3d_architecture(): void
    {
        $response = $this->get(route('store3d-architectures.create'));

        $response->assertOk()->assertViewIs('app.store3d_architectures.create');
    }

    /**
     * @test
     */
    public function it_stores_the_store3d_architecture(): void
    {
        $data = Store3dArchitecture::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('store3d-architectures.store'), $data);

        $this->assertDatabaseHas('store3d_architectures', $data);

        $store3dArchitecture = Store3dArchitecture::latest('id')->first();

        $response->assertRedirect(
            route('store3d-architectures.edit', $store3dArchitecture)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_store3d_architecture(): void
    {
        $store3dArchitecture = Store3dArchitecture::factory()->create();

        $response = $this->get(
            route('store3d-architectures.show', $store3dArchitecture)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_architectures.show')
            ->assertViewHas('store3dArchitecture');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_store3d_architecture(): void
    {
        $store3dArchitecture = Store3dArchitecture::factory()->create();

        $response = $this->get(
            route('store3d-architectures.edit', $store3dArchitecture)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.store3d_architectures.edit')
            ->assertViewHas('store3dArchitecture');
    }

    /**
     * @test
     */
    public function it_updates_the_store3d_architecture(): void
    {
        $store3dArchitecture = Store3dArchitecture::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'file' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('store3d-architectures.update', $store3dArchitecture),
            $data
        );

        $data['id'] = $store3dArchitecture->id;

        $this->assertDatabaseHas('store3d_architectures', $data);

        $response->assertRedirect(
            route('store3d-architectures.edit', $store3dArchitecture)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_store3d_architecture(): void
    {
        $store3dArchitecture = Store3dArchitecture::factory()->create();

        $response = $this->delete(
            route('store3d-architectures.destroy', $store3dArchitecture)
        );

        $response->assertRedirect(route('store3d-architectures.index'));

        $this->assertModelMissing($store3dArchitecture);
    }
}
