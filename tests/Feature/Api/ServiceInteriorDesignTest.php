<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ServiceInteriorDesign;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceInteriorDesignTest extends TestCase
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
    public function it_gets_service_interior_designs_list(): void
    {
        $serviceInteriorDesigns = ServiceInteriorDesign::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.service-interior-designs.index'));

        $response->assertOk()->assertSee($serviceInteriorDesigns[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_service_interior_design(): void
    {
        $data = ServiceInteriorDesign::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.service-interior-designs.store'),
            $data
        );

        $this->assertDatabaseHas('service_interior_designs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route(
                'api.service-interior-designs.update',
                $serviceInteriorDesign
            ),
            $data
        );

        $data['id'] = $serviceInteriorDesign->id;

        $this->assertDatabaseHas('service_interior_designs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_service_interior_design(): void
    {
        $serviceInteriorDesign = ServiceInteriorDesign::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.service-interior-designs.destroy',
                $serviceInteriorDesign
            )
        );

        $this->assertModelMissing($serviceInteriorDesign);

        $response->assertNoContent();
    }
}
