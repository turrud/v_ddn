<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ServiceWeddingDecoration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceWeddingDecorationControllerTest extends TestCase
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
    public function it_displays_index_view_with_service_wedding_decorations(): void
    {
        $serviceWeddingDecorations = ServiceWeddingDecoration::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('service-wedding-decorations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_wedding_decorations.index')
            ->assertViewHas('serviceWeddingDecorations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_service_wedding_decoration(): void
    {
        $response = $this->get(route('service-wedding-decorations.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.service_wedding_decorations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_service_wedding_decoration(): void
    {
        $data = ServiceWeddingDecoration::factory()
            ->make()
            ->toArray();

        $response = $this->post(
            route('service-wedding-decorations.store'),
            $data
        );

        $this->assertDatabaseHas('service_wedding_decorations', $data);

        $serviceWeddingDecoration = ServiceWeddingDecoration::latest(
            'id'
        )->first();

        $response->assertRedirect(
            route('service-wedding-decorations.edit', $serviceWeddingDecoration)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_service_wedding_decoration(): void
    {
        $serviceWeddingDecoration = ServiceWeddingDecoration::factory()->create();

        $response = $this->get(
            route('service-wedding-decorations.show', $serviceWeddingDecoration)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_wedding_decorations.show')
            ->assertViewHas('serviceWeddingDecoration');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_service_wedding_decoration(): void
    {
        $serviceWeddingDecoration = ServiceWeddingDecoration::factory()->create();

        $response = $this->get(
            route('service-wedding-decorations.edit', $serviceWeddingDecoration)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.service_wedding_decorations.edit')
            ->assertViewHas('serviceWeddingDecoration');
    }

    /**
     * @test
     */
    public function it_updates_the_service_wedding_decoration(): void
    {
        $serviceWeddingDecoration = ServiceWeddingDecoration::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'progres' => 'finish',
        ];

        $response = $this->put(
            route(
                'service-wedding-decorations.update',
                $serviceWeddingDecoration
            ),
            $data
        );

        $data['id'] = $serviceWeddingDecoration->id;

        $this->assertDatabaseHas('service_wedding_decorations', $data);

        $response->assertRedirect(
            route('service-wedding-decorations.edit', $serviceWeddingDecoration)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_service_wedding_decoration(): void
    {
        $serviceWeddingDecoration = ServiceWeddingDecoration::factory()->create();

        $response = $this->delete(
            route(
                'service-wedding-decorations.destroy',
                $serviceWeddingDecoration
            )
        );

        $response->assertRedirect(route('service-wedding-decorations.index'));

        $this->assertModelMissing($serviceWeddingDecoration);
    }
}
