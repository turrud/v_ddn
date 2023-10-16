<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AboutAward;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutAwardControllerTest extends TestCase
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
    public function it_displays_index_view_with_about_awards(): void
    {
        $aboutAwards = AboutAward::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('about-awards.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.about_awards.index')
            ->assertViewHas('aboutAwards');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_about_award(): void
    {
        $response = $this->get(route('about-awards.create'));

        $response->assertOk()->assertViewIs('app.about_awards.create');
    }

    /**
     * @test
     */
    public function it_stores_the_about_award(): void
    {
        $data = AboutAward::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('about-awards.store'), $data);

        $this->assertDatabaseHas('about_awards', $data);

        $aboutAward = AboutAward::latest('id')->first();

        $response->assertRedirect(route('about-awards.edit', $aboutAward));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_about_award(): void
    {
        $aboutAward = AboutAward::factory()->create();

        $response = $this->get(route('about-awards.show', $aboutAward));

        $response
            ->assertOk()
            ->assertViewIs('app.about_awards.show')
            ->assertViewHas('aboutAward');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_about_award(): void
    {
        $aboutAward = AboutAward::factory()->create();

        $response = $this->get(route('about-awards.edit', $aboutAward));

        $response
            ->assertOk()
            ->assertViewIs('app.about_awards.edit')
            ->assertViewHas('aboutAward');
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

        $response = $this->put(
            route('about-awards.update', $aboutAward),
            $data
        );

        $data['id'] = $aboutAward->id;

        $this->assertDatabaseHas('about_awards', $data);

        $response->assertRedirect(route('about-awards.edit', $aboutAward));
    }

    /**
     * @test
     */
    public function it_deletes_the_about_award(): void
    {
        $aboutAward = AboutAward::factory()->create();

        $response = $this->delete(route('about-awards.destroy', $aboutAward));

        $response->assertRedirect(route('about-awards.index'));

        $this->assertModelMissing($aboutAward);
    }
}
