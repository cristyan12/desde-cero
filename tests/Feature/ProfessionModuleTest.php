<?php

namespace Tests\Feature;

use App\Profession;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $response = $this->get(route('professions.create'))
            ->assertStatus(200)
            ->assertViewIs('professions.create')
            ->assertSee('Crear nueva profesión');
    }

    /** @test */
    function it_can_create_a_new_profession()
    {
        $this->withoutExceptionHandling();
        
        $this->post(route('professions.store'), [
            'title' => 'Profesión 101'
        ])->assertRedirect(route('professions.index'));

        $this->assertDatabaseHas('professions', [
            'title' => 'Profesión 101'
        ]);
    }

    /** @test */
    function the_title_field_is_required()
    {
        $response = $this->from('/professions')
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

        $response = $this->from('/professions')
            ->post(route('professions.store'), [
                'title' => 'Profesión 101'
            ])
            ->assertRedirect(route('professions.store'))
            ->assertSessionHasErrors(['title']);

        $this->assertSame(1, Profession::count());
    }
}
