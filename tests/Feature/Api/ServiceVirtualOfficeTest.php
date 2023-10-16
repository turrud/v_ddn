<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ServiceVirtualOffice;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceVirtualOfficeTest extends TestCase
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
    public function it_gets_service_virtual_offices_list(): void
    {
        $serviceVirtualOffices = ServiceVirtualOffice::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.service-virtual-offices.index'));

        $response->assertOk()->assertSee($serviceVirtualOffices[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_service_virtual_office(): void
    {
        $data = ServiceVirtualOffice::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.service-virtual-offices.store'),
            $data
        );

        $this->assertDatabaseHas('service_virtual_offices', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.service-virtual-offices.update', $serviceVirtualOffice),
            $data
        );

        $data['id'] = $serviceVirtualOffice->id;

        $this->assertDatabaseHas('service_virtual_offices', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_service_virtual_office(): void
    {
        $serviceVirtualOffice = ServiceVirtualOffice::factory()->create();

        $response = $this->deleteJson(
            route('api.service-virtual-offices.destroy', $serviceVirtualOffice)
        );

        $this->assertModelMissing($serviceVirtualOffice);

        $response->assertNoContent();
    }
}
