<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ServiceArchitecture;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceArchitectureControllerTest extends TestCase
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
    public function it_displays_index_view_with_service_architectures(): void
    {
        $serviceArchitectures = ServiceArchitecture::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('service-architectures.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_architectures.index')
            ->assertViewHas('serviceArchitectures');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_service_architecture(): void
    {
        $response = $this->get(route('service-architectures.create'));

        $response->assertOk()->assertViewIs('app.service_architectures.create');
    }

    /**
     * @test
     */
    public function it_stores_the_service_architecture(): void
    {
        $data = ServiceArchitecture::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('service-architectures.store'), $data);

        $this->assertDatabaseHas('service_architectures', $data);

        $serviceArchitecture = ServiceArchitecture::latest('id')->first();

        $response->assertRedirect(
            route('service-architectures.edit', $serviceArchitecture)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_service_architecture(): void
    {
        $serviceArchitecture = ServiceArchitecture::factory()->create();

        $response = $this->get(
            route('service-architectures.show', $serviceArchitecture)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_architectures.show')
            ->assertViewHas('serviceArchitecture');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_service_architecture(): void
    {
        $serviceArchitecture = ServiceArchitecture::factory()->create();

        $response = $this->get(
            route('service-architectures.edit', $serviceArchitecture)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_architectures.edit')
            ->assertViewHas('serviceArchitecture');
    }

    /**
     * @test
     */
    public function it_updates_the_service_architecture(): void
    {
        $serviceArchitecture = ServiceArchitecture::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->put(
            route('service-architectures.update', $serviceArchitecture),
            $data
        );

        $data['id'] = $serviceArchitecture->id;

        $this->assertDatabaseHas('service_architectures', $data);

        $response->assertRedirect(
            route('service-architectures.edit', $serviceArchitecture)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_service_architecture(): void
    {
        $serviceArchitecture = ServiceArchitecture::factory()->create();

        $response = $this->delete(
            route('service-architectures.destroy', $serviceArchitecture)
        );

        $response->assertRedirect(route('service-architectures.index'));

        $this->assertModelMissing($serviceArchitecture);
    }
}
