<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\News;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
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
    public function it_gets_all_news_list(): void
    {
        $allNews = News::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-news.index'));

        $response->assertOk()->assertSee($allNews[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_news(): void
    {
        $data = News::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-news.store'), $data);

        $this->assertDatabaseHas('news', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_news(): void
    {
        $news = News::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'text' => $this->faker->text(),
            'excerpt' => $this->faker->text(),
        ];

        $response = $this->putJson(route('api.all-news.update', $news), $data);

        $data['id'] = $news->id;

        $this->assertDatabaseHas('news', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_news(): void
    {
        $news = News::factory()->create();

        $response = $this->deleteJson(route('api.all-news.destroy', $news));

        $this->assertModelMissing($news);

        $response->assertNoContent();
    }
}