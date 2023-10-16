<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ServiceBoothDesign;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceBoothDesignControllerTest extends TestCase
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
    public function it_displays_index_view_with_service_booth_designs(): void
    {
        $serviceBoothDesigns = ServiceBoothDesign::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('service-booth-designs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_booth_designs.index')
            ->assertViewHas('serviceBoothDesigns');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_service_booth_design(): void
    {
        $response = $this->get(route('service-booth-designs.create'));

        $response->assertOk()->assertViewIs('app.service_booth_designs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_service_booth_design(): void
    {
        $data = ServiceBoothDesign::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('service-booth-designs.store'), $data);

        $this->assertDatabaseHas('service_booth_designs', $data);

        $serviceBoothDesign = ServiceBoothDesign::latest('id')->first();

        $response->assertRedirect(
            route('service-booth-designs.edit', $serviceBoothDesign)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_service_booth_design(): void
    {
        $serviceBoothDesign = ServiceBoothDesign::factory()->create();

        $response = $this->get(
            route('service-booth-designs.show', $serviceBoothDesign)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_booth_designs.show')
            ->assertViewHas('serviceBoothDesign');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_service_booth_design(): void
    {
        $serviceBoothDesign = ServiceBoothDesign::factory()->create();

        $response = $this->get(
            route('service-booth-designs.edit', $serviceBoothDesign)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_booth_designs.edit')
            ->assertViewHas('serviceBoothDesign');
    }

    /**
     * @test
     */
    public function it_updates_the_service_booth_design(): void
    {
        $serviceBoothDesign = ServiceBoothDesign::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->put(
            route('service-booth-designs.update', $serviceBoothDesign),
            $data
        );

        $data['id'] = $serviceBoothDesign->id;

        $this->assertDatabaseHas('service_booth_designs', $data);

        $response->assertRedirect(
            route('service-booth-designs.edit', $serviceBoothDesign)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_service_booth_design(): void
    {
        $serviceBoothDesign = ServiceBoothDesign::factory()->create();

        $response = $this->delete(
            route('service-booth-designs.destroy', $serviceBoothDesign)
        );

        $response->assertRedirect(route('service-booth-designs.index'));

        $this->assertModelMissing($serviceBoothDesign);
    }
}
