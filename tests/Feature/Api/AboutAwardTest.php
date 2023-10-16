<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AboutAward;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutAwardTest extends TestCase
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
    public function it_gets_about_awards_list(): void
    {
        $aboutAwards = AboutAward::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.about-awards.index'));

        $response->assertOk()->assertSee($aboutAwards[0]->tanggal);
    }

    /**
     * @test
     */
    public function it_stores_the_about_award(): void
    {
        $data = AboutAward::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.about-awards.store'), $data);

        $this->assertDatabaseHas('about_awards', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_about_award(): void
    {
        $aboutAward = AboutAward::factory()->create();

        $data = [
            'tanggal' => $this->faker->text(255),
            'award1' => $this->faker->text(255),
            'award2' => $this->faker->text(255),
            'award3' => $this->faker->text(255),
            'award4' => $this->faker->text(255),
            'award5' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.about-awards.update', $aboutAward),
            $data
        );

        $data['id'] = $aboutAward->id;

        $this->assertDatabaseHas('about_awards', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_about_award(): void
    {
        $aboutAward = AboutAward::factory()->create();

        $response = $this->deleteJson(
            route('api.about-awards.destroy', $aboutAward)
        );

        $this->assertModelMissing($aboutAward);

        $response->assertNoContent();
    }
}
