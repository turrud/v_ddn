<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AboutEvent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutEventControllerTest extends TestCase
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
    public function it_displays_index_view_with_about_events(): void
    {
        $aboutEvents = AboutEvent::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('about-events.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.about_events.index')
            ->assertViewHas('aboutEvents');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_about_event(): void
    {
        $response = $this->get(route('about-events.create'));

        $response->assertOk()->assertViewIs('app.about_events.create');
    }

    /**
     * @test
     */
    public function it_stores_the_about_event(): void
    {
        $data = AboutEvent::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('about-events.store'), $data);

        $this->assertDatabaseHas('about_events', $data);

        $aboutEvent = AboutEvent::latest('id')->first();

        $response->assertRedirect(route('about-events.edit', $aboutEvent));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_about_event(): void
    {
        $aboutEvent = AboutEvent::factory()->create();

        $response = $this->get(route('about-events.show', $aboutEvent));

        $response
            ->assertOk()
            ->assertViewIs('app.about_events.show')
            ->assertViewHas('aboutEvent');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_about_event(): void
    {
        $aboutEvent = AboutEvent::factory()->create();

        $response = $this->get(route('about-events.edit', $aboutEvent));

        $response
            ->assertOk()
            ->assertViewIs('app.about_events.edit')
            ->assertViewHas('aboutEvent');
    }

    /**
     * @test
     */
    public function it_updates_the_about_event(): void
    {
        $aboutEvent = AboutEvent::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'tanggal' => $this->faker->text(255),
            'lokasi' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('about-events.update', $aboutEvent),
            $data
        );

        $data['id'] = $aboutEvent->id;

        $this->assertDatabaseHas('about_events', $data);

        $response->assertRedirect(route('about-events.edit', $aboutEvent));
    }

    /**
     * @test
     */
    public function it_deletes_the_about_event(): void
    {
        $aboutEvent = AboutEvent::factory()->create();

        $response = $this->delete(route('about-events.destroy', $aboutEvent));

        $response->assertRedirect(route('about-events.index'));

        $this->assertModelMissing($aboutEvent);
    }
}
