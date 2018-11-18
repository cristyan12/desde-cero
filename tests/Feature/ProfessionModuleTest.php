<?php

namespace Tests\Feature;

use App\{ProfessionUser, Profession};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfessionModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_can_loads_the_list_of_professions()
    {
        $profession = $this->create(Profession::class, ['title' => 'Profesión 101']);

        $response = $this->get(route('professions.index'))
            ->assertStatus(200)
            ->assertViewIs('professions.index')
            ->assertViewHas('professions')
            ->assertSee('Listado de profesiones')
            ->assertSee('Profesión 101');
    }

    /** @test */
    function it_can_loads_the_new_page_of_professions()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('professions.create'))
            ->assertStatus(200)
            ->assertViewIs('professions.create')
            ->assertSee('Crear nueva profesión');
    }

    /** @test */
    function it_can_create_a_new_profession()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->someUser())
            ->post(route('professions.store'), [
                'title' => 'Profesión 101'
            ])->assertRedirect(route('professions.index'));

        $this->assertDatabaseHas('professions', [
            'title' => 'Profesión 101'
        ]);
    }

    /** @test */
    function the_title_field_is_required()
    {
        $response = $this->actingAs($this->someUser())
            ->from('/professions')
            ->post(route('professions.store'), [
                'title' => ''
            ])
            ->assertRedirect(route('professions.store'))
            ->assertSessionHasErrors(['title']);

        $this->assertSame(0, Profession::count());
    }

    /** @test */
    function the_title_field_must_be_unique()
    {
        $profession = $this->create(Profession::class, ['title' => 'Profesión 101']);

        $response = $this->actingAs($this->someUser())
            ->from('/professions')
            ->post(route('professions.store'), [
                'title' => 'Profesión 101'
            ])
            ->assertRedirect(route('professions.store'))
            ->assertSessionHasErrors(['title']);

        $this->assertSame(1, Profession::count());
    }

     /** @test */
    function it_loads_the_profession_details()
    {
        $profession = $this->create(Profession::class, [
            'title' => 'Profesión 101'
        ]);

        $response = $this->get(route('professions.show', $profession))
            ->assertStatus(200)
            ->assertViewIs('professions.show')
            ->assertViewHas('profession')
            ->assertSee('Detalle de la profesión')
            ->assertSee('Profesión 101');
    }

    /** @test */
    function it_can_loads_the_edit_page_of_professions()
    {
        $this->withoutExceptionHandling();

        $profession = $this->create(Profession::class, [
            'title' => 'Carpintero'
        ]);

        $response = $this->actingAs($this->someUser())
            ->get(route('professions.edit', $profession))
            ->assertStatus(200)
            ->assertViewIs('professions.edit')
            ->assertViewHas('profession')
            ->assertSee('Actualizar Profesión')
            ->assertSee('Carpintero');
    }

    /** @test */
    function it_update_a_profession()
    {
        $this->withoutExceptionHandling();

        $profession = $this->create(Profession::class);

        $this->actingAs($this->someUser())->put(route('professions.update', $profession), [
            'title' => 'Carpintero'
        ])->assertRedirect(route('professions.show', $profession));

        $this->assertDatabaseHas('professions', ['title' => 'Carpintero']);
    }

     /** @test */
    function the_title_must_be_unique_when_updating_a_profession()
    {
        $existing = $this->create(Profession::class, [
            'title' => 'Existing-profession'
        ]);

        $profession = $this->create(Profession::class, [
            'title' => 'Another-profession'
        ]);

        $this->actingAs($this->someUser())->from(route('professions.edit', $profession))
            ->put("professions/{$profession->id}", [
                'title' => 'Existing-profession'
            ])
            ->assertRedirect(route('professions.edit', $profession))
            ->assertSessionHasErrors(['title']);
    }
}
