<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_users_list()
    {
        $response = $this->get('/users')
            ->assertStatus(200)
            ->assertSee('Usuarios');
    }

    /** @test */
    function it_loads_the_user_details()
    {
        $user = factory(User::class)->create([
            'name' => 'Cristyan Valera',
            'email' => 'cristyan12@mail.com'
        ]);
        
        $response = $this->get('/users/1')
            ->assertStatus(200)
            ->assertSee("Cristyan Valera")
            ->assertSee('cristyan12@mail.com');
    }

    /** @test */
    function it_show_a_default_message_when_list_of_user_is_empty()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get(route('users.index'))
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    function it_loads_the_new_user_page()
    {
        $response = $this->get('/users/new')
            ->assertStatus(200)
            ->assertViewIs('users.create')
            ->assertSee('Crear Usuario');
    }

     /** @test */
    function it_loads_the_edit_user_page()
    {
        $response = $this->get('/users/5/edit')
            ->assertStatus(200)
            ->assertSee('Editando usuario: 5');
    }
}
