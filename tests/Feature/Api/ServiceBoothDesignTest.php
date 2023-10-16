<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ServiceBoothDesign;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceBoothDesignTest extends TestCase
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
    public function it_gets_service_booth_designs_list(): void
    {
        $serviceBoothDesigns = ServiceBoothDesign::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.service-booth-designs.index'));

        $response->assertOk()->assertSee($serviceBoothDesigns[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_service_booth_design(): void
    {
        $data = ServiceBoothDesign::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.service-booth-designs.store'),
            $data
        );

        $this->assertDatabaseHas('service_booth_designs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.service-booth-designs.update', $serviceBoothDesign),
            $data
        );

        $data['id'] = $serviceBoothDesign->id;

        $this->assertDatabaseHas('service_booth_designs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_service_booth_design(): void
    {
        $serviceBoothDesign = ServiceBoothDesign::factory()->create();

        $response = $this->deleteJson(
            route('api.service-booth-designs.destroy', $serviceBoothDesign)
        );

        $this->assertModelMissing($serviceBoothDesign);

        $response->assertNoContent();
    }
}
