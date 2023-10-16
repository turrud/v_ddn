<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContactInvest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactInvestTest extends TestCase
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
    public function it_gets_contact_invests_list(): void
    {
        $contactInvests = ContactInvest::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contact-invests.index'));

        $response->assertOk()->assertSee($contactInvests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contact_invest(): void
    {
        $data = ContactInvest::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contact-invests.store'), $data);

        $this->assertDatabaseHas('contact_invests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_contact_invest(): void
    {
        $contactInvest = ContactInvest::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'instansi' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.contact-invests.update', $contactInvest),
            $data
        );

        $data['id'] = $contactInvest->id;

        $this->assertDatabaseHas('contact_invests', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_invest(): void
    {
        $contactInvest = ContactInvest::factory()->create();

        $response = $this->deleteJson(
            route('api.contact-invests.destroy', $contactInvest)
        );

        $this->assertModelMissing($contactInvest);

        $response->assertNoContent();
    }
}
