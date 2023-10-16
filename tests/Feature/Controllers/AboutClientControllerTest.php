<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AboutClient;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutClientControllerTest extends TestCase
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
    public function it_displays_index_view_with_about_clients(): void
    {
        $aboutClients = AboutClient::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('about-clients.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.about_clients.index')
            ->assertViewHas('aboutClients');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_about_client(): void
    {
        $response = $this->get(route('about-clients.create'));

        $response->assertOk()->assertViewIs('app.about_clients.create');
    }

    /**
     * @test
     */
    public function it_stores_the_about_client(): void
    {
        $data = AboutClient::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('about-clients.store'), $data);

        $this->assertDatabaseHas('about_clients', $data);

        $aboutClient = AboutClient::latest('id')->first();

        $response->assertRedirect(route('about-clients.edit', $aboutClient));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_about_client(): void
    {
        $aboutClient = AboutClient::factory()->create();

        $response = $this->get(route('about-clients.show', $aboutClient));

        $response
            ->assertOk()
            ->assertViewIs('app.about_clients.show')
            ->assertViewHas('aboutClient');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_about_client(): void
    {
        $aboutClient = AboutClient::factory()->create();

        $response = $this->get(route('about-clients.edit', $aboutClient));

        $response
            ->assertOk()
            ->assertViewIs('app.about_clients.edit')
            ->assertViewHas('aboutClient');
    }

    /**
     * @test
     */
    public function it_updates_the_about_client(): void
    {
        $aboutClient = AboutClient::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->put(
            route('about-clients.update', $aboutClient),
            $data
        );

        $data['id'] = $aboutClient->id;

        $this->assertDatabaseHas('about_clients', $data);

        $response->assertRedirect(route('about-clients.edit', $aboutClient));
    }

    /**
     * @test
     */
    public function it_deletes_the_about_client(): void
    {
        $aboutClient = AboutClient::factory()->create();

        $response = $this->delete(route('about-clients.destroy', $aboutClient));

        $response->assertRedirect(route('about-clients.index'));

        $this->assertModelMissing($aboutClient);
    }
}
