<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AboutEvent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutEventTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_about_events_list(): void
    {
        $aboutEvents = AboutEvent::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.about-events.index'));

        $response->assertOk()->assertSee($aboutEvents[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_about_event(): void
    {
        $data = AboutEvent::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.about-events.store'), $data);

        $this->assertDatabaseHas('about_events', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.about-events.update', $aboutEvent),
            $data
        );

        $data['id'] = $aboutEvent->id;

        $this->assertDatabaseHas('about_events', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_about_event(): void
    {
        $aboutEvent = AboutEvent::factory()->create();

        $response = $this->deleteJson(
            route('api.about-events.destroy', $aboutEvent)
        );

        $this->assertModelMissing($aboutEvent);

        $response->assertNoContent();
    }
}
