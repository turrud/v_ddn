<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AboutPeople;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutPeopleTest extends TestCase
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
    public function it_gets_all_about_people_list(): void
    {
        $allAboutPeople = AboutPeople::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-about-people.index'));

        $response->assertOk()->assertSee($allAboutPeople[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_about_people(): void
    {
        $data = AboutPeople::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-about-people.store'), $data);

        $this->assertDatabaseHas('about_people', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_about_people(): void
    {
        $aboutPeople = AboutPeople::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'jabatan' => $this->faker->text(255),
            'text' => $this->faker->text(),
        ];

        $response = $this->putJson(
            route('api.all-about-people.update', $aboutPeople),
            $data
        );

        $data['id'] = $aboutPeople->id;

        $this->assertDatabaseHas('about_people', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_about_people(): void
    {
        $aboutPeople = AboutPeople::factory()->create();

        $response = $this->deleteJson(
            route('api.all-about-people.destroy', $aboutPeople)
        );

        $this->assertModelMissing($aboutPeople);

        $response->assertNoContent();
    }
}
