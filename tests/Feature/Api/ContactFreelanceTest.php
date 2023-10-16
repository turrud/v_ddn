<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContactFreelance;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFreelanceTest extends TestCase
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
    public function it_gets_contact_freelances_list(): void
    {
        $contactFreelances = ContactFreelance::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contact-freelances.index'));

        $response->assertOk()->assertSee($contactFreelances[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contact_freelance(): void
    {
        $data = ContactFreelance::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.contact-freelances.store'),
            $data
        );

        $this->assertDatabaseHas('contact_freelances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_contact_freelance(): void
    {
        $contactFreelance = ContactFreelance::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'introduce' => $this->faker->text(),
            'file' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.contact-freelances.update', $contactFreelance),
            $data
        );

        $data['id'] = $contactFreelance->id;

        $this->assertDatabaseHas('contact_freelances', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_freelance(): void
    {
        $contactFreelance = ContactFreelance::factory()->create();

        $response = $this->deleteJson(
            route('api.contact-freelances.destroy', $contactFreelance)
        );

        $this->assertModelMissing($contactFreelance);

        $response->assertNoContent();
    }
}
