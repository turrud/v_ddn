<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ServiceVirtualOffice;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceVirtualOfficeControllerTest extends TestCase
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
    public function it_displays_index_view_with_service_virtual_offices(): void
    {
        $serviceVirtualOffices = ServiceVirtualOffice::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('service-virtual-offices.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_virtual_offices.index')
            ->assertViewHas('serviceVirtualOffices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_service_virtual_office(): void
    {
        $response = $this->get(route('service-virtual-offices.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_virtual_offices.create');
    }

    /**
     * @test
     */
    public function it_stores_the_service_virtual_office(): void
    {
        $data = ServiceVirtualOffice::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('service-virtual-offices.store'), $data);

        $this->assertDatabaseHas('service_virtual_offices', $data);

        $serviceVirtualOffice = ServiceVirtualOffice::latest('id')->first();

        $response->assertRedirect(
            route('service-virtual-offices.edit', $serviceVirtualOffice)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_service_virtual_office(): void
    {
        $serviceVirtualOffice = ServiceVirtualOffice::factory()->create();

        $response = $this->get(
            route('service-virtual-offices.show', $serviceVirtualOffice)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_virtual_offices.show')
            ->assertViewHas('serviceVirtualOffice');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_service_virtual_office(): void
    {
        $serviceVirtualOffice = ServiceVirtualOffice::factory()->create();

        $response = $this->get(
            route('service-virtual-offices.edit', $serviceVirtualOffice)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_virtual_offices.edit')
            ->assertViewHas('serviceVirtualOffice');
    }

    /**
     * @test
     */
    public function it_updates_the_service_virtual_office(): void
    {
        $serviceVirtualOffice = ServiceVirtualOffice::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->put(
            route('service-virtual-offices.update', $serviceVirtualOffice),
            $data
        );

        $data['id'] = $serviceVirtualOffice->id;

        $this->assertDatabaseHas('service_virtual_offices', $data);

        $response->assertRedirect(
            route('service-virtual-offices.edit', $serviceVirtualOffice)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_service_virtual_office(): void
    {
        $serviceVirtualOffice = ServiceVirtualOffice::factory()->create();

        $response = $this->delete(
            route('service-virtual-offices.destroy', $serviceVirtualOffice)
        );

        $response->assertRedirect(route('service-virtual-offices.index'));

        $this->assertModelMissing($serviceVirtualOffice);
    }
}
