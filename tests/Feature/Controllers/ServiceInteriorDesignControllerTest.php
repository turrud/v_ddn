<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ServiceInteriorDesign;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceInteriorDesignControllerTest extends TestCase
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
    public function it_displays_index_view_with_service_interior_designs(): void
    {
        $serviceInteriorDesigns = ServiceInteriorDesign::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('service-interior-designs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_interior_designs.index')
            ->assertViewHas('serviceInteriorDesigns');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_service_interior_design(): void
    {
        $response = $this->get(route('service-interior-designs.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_interior_designs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_service_interior_design(): void
    {
        $data = ServiceInteriorDesign::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('service-interior-designs.store'), $data);

        $this->assertDatabaseHas('service_interior_designs', $data);

        $serviceInteriorDesign = ServiceInteriorDesign::latest('id')->first();

        $response->assertRedirect(
            route('service-interior-designs.edit', $serviceInteriorDesign)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_service_interior_design(): void
    {
        $serviceInteriorDesign = ServiceInteriorDesign::factory()->create();

        $response = $this->get(
            route('service-interior-designs.show', $serviceInteriorDesign)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_interior_designs.show')
            ->assertViewHas('serviceInteriorDesign');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_service_interior_design(): void
    {
        $serviceInteriorDesign = ServiceInteriorDesign::factory()->create();

        $response = $this->get(
            route('service-interior-designs.edit', $serviceInteriorDesign)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_interior_designs.edit')
            ->assertViewHas('serviceInteriorDesign');
    }

    /**
     * @test
     */
    public function it_updates_the_service_interior_design(): void
    {
        $serviceInteriorDesign = ServiceInteriorDesign::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->put(
            route('service-interior-designs.update', $serviceInteriorDesign),
            $data
        );

        $data['id'] = $serviceInteriorDesign->id;

        $this->assertDatabaseHas('service_interior_designs', $data);

        $response->assertRedirect(
            route('service-interior-designs.edit', $serviceInteriorDesign)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_service_interior_design(): void
    {
        $serviceInteriorDesign = ServiceInteriorDesign::factory()->create();

        $response = $this->delete(
            route('service-interior-designs.destroy', $serviceInteriorDesign)
        );

        $response->assertRedirect(route('service-interior-designs.index'));

        $this->assertModelMissing($serviceInteriorDesign);
    }
}
