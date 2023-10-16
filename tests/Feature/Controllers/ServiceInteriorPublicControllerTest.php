<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ServiceInteriorPublic;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceInteriorPublicControllerTest extends TestCase
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
    public function it_displays_index_view_with_service_interior_publics(): void
    {
        $serviceInteriorPublics = ServiceInteriorPublic::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('service-interior-publics.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_interior_publics.index')
            ->assertViewHas('serviceInteriorPublics');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_service_interior_public(): void
    {
        $response = $this->get(route('service-interior-publics.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_interior_publics.create');
    }

    /**
     * @test
     */
    public function it_stores_the_service_interior_public(): void
    {
        $data = ServiceInteriorPublic::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('service-interior-publics.store'), $data);

        $this->assertDatabaseHas('service_interior_publics', $data);

        $serviceInteriorPublic = ServiceInteriorPublic::latest('id')->first();

        $response->assertRedirect(
            route('service-interior-publics.edit', $serviceInteriorPublic)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_service_interior_public(): void
    {
        $serviceInteriorPublic = ServiceInteriorPublic::factory()->create();

        $response = $this->get(
            route('service-interior-publics.show', $serviceInteriorPublic)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_interior_publics.show')
            ->assertViewHas('serviceInteriorPublic');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_service_interior_public(): void
    {
        $serviceInteriorPublic = ServiceInteriorPublic::factory()->create();

        $response = $this->get(
            route('service-interior-publics.edit', $serviceInteriorPublic)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_interior_publics.edit')
            ->assertViewHas('serviceInteriorPublic');
    }

    /**
     * @test
     */
    public function it_updates_the_service_interior_public(): void
    {
        $serviceInteriorPublic = ServiceInteriorPublic::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->put(
            route('service-interior-publics.update', $serviceInteriorPublic),
            $data
        );

        $data['id'] = $serviceInteriorPublic->id;

        $this->assertDatabaseHas('service_interior_publics', $data);

        $response->assertRedirect(
            route('service-interior-publics.edit', $serviceInteriorPublic)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_service_interior_public(): void
    {
        $serviceInteriorPublic = ServiceInteriorPublic::factory()->create();

        $response = $this->delete(
            route('service-interior-publics.destroy', $serviceInteriorPublic)
        );

        $response->assertRedirect(route('service-interior-publics.index'));

        $this->assertModelMissing($serviceInteriorPublic);
    }
}
