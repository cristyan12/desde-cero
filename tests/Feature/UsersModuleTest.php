<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
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
        $response = $this->get('/users/1')
            ->assertStatus(200)
            ->assertSee('Mostrando el detalle del usuario: 1');
    }

    /** @test */
    function it_loads_the_new_user_page()
    {
        $response = $this->get('/users/new')
            ->assertStatus(200)
            ->assertSee('Crear usuario');
    }

     /** @test */
    function it_loads_the_edit_user_page()
    {
        $response = $this->get('/users/5/edit')
            ->assertStatus(200)
            ->assertSee('Editando usuario: 5');
    }
}
