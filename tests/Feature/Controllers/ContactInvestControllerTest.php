<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContactInvest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactInvestControllerTest extends TestCase
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
    public function it_displays_index_view_with_contact_invests(): void
    {
        $contactInvests = ContactInvest::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contact-invests.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_invests.index')
            ->assertViewHas('contactInvests');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contact_invest(): void
    {
        $response = $this->get(route('contact-invests.create'));

        $response->assertOk()->assertViewIs('app.contact_invests.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contact_invest(): void
    {
        $data = ContactInvest::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contact-invests.store'), $data);

        $this->assertDatabaseHas('contact_invests', $data);

        $contactInvest = ContactInvest::latest('id')->first();

        $response->assertRedirect(
            route('contact-invests.edit', $contactInvest)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contact_invest(): void
    {
        $contactInvest = ContactInvest::factory()->create();

        $response = $this->get(route('contact-invests.show', $contactInvest));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_invests.show')
            ->assertViewHas('contactInvest');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contact_invest(): void
    {
        $contactInvest = ContactInvest::factory()->create();

        $response = $this->get(route('contact-invests.edit', $contactInvest));

        $response
            ->assertOk()
            ->assertViewIs('app.contact_invests.edit')
            ->assertViewHas('contactInvest');
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

        $response = $this->put(
            route('contact-invests.update', $contactInvest),
            $data
        );

        $data['id'] = $contactInvest->id;

        $this->assertDatabaseHas('contact_invests', $data);

        $response->assertRedirect(
            route('contact-invests.edit', $contactInvest)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_contact_invest(): void
    {
        $contactInvest = ContactInvest::factory()->create();

        $response = $this->delete(
            route('contact-invests.destroy', $contactInvest)
        );

        $response->assertRedirect(route('contact-invests.index'));

        $this->assertModelMissing($contactInvest);
    }
}
