<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AboutPeople;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutPeopleControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_about_people(): void
    {
        $allAboutPeople = AboutPeople::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-about-people.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_about_people.index')
            ->assertViewHas('allAboutPeople');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_about_people(): void
    {
        $response = $this->get(route('all-about-people.create'));

        $response->assertOk()->assertViewIs('app.all_about_people.create');
    }

    /**
     * @test
     */
    public function it_stores_the_about_people(): void
    {
        $data = AboutPeople::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-about-people.store'), $data);

        $this->assertDatabaseHas('about_people', $data);

        $aboutPeople = AboutPeople::latest('id')->first();

        $response->assertRedirect(route('all-about-people.edit', $aboutPeople));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_about_people(): void
    {
        $aboutPeople = AboutPeople::factory()->create();

        $response = $this->get(route('all-about-people.show', $aboutPeople));

        $response
            ->assertOk()
            ->assertViewIs('app.all_about_people.show')
            ->assertViewHas('aboutPeople');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_about_people(): void
    {
        $aboutPeople = AboutPeople::factory()->create();

        $response = $this->get(route('all-about-people.edit', $aboutPeople));

        $response
            ->assertOk()
            ->assertViewIs('app.all_about_people.edit')
            ->assertViewHas('aboutPeople');
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

        $response = $this->put(
            route('all-about-people.update', $aboutPeople),
            $data
        );

        $data['id'] = $aboutPeople->id;

        $this->assertDatabaseHas('about_people', $data);

        $response->assertRedirect(route('all-about-people.edit', $aboutPeople));
    }

    /**
     * @test
     */
    public function it_deletes_the_about_people(): void
    {
        $aboutPeople = AboutPeople::factory()->create();

        $response = $this->delete(
            route('all-about-people.destroy', $aboutPeople)
        );

        $response->assertRedirect(route('all-about-people.index'));

        $this->assertModelMissing($aboutPeople);
    }
}
