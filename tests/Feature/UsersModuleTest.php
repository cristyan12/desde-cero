<?php

namespace Tests\Feature;

use App\{User, Profession};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_new_user_page()
    {
        $response = $this->get('/users/create')
            ->assertStatus(200)
            ->assertViewIs('users.create')
            ->assertSee('Crear Usuario');
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $this->withoutExceptionHandling();

        $profession = factory(Profession::class)->create([
            'title' => 'Desarrollador web'
        ]);

        $this->post(route('users.store'), [
            'name' => 'Cristyan',
            'email' => 'cristyan12@mail.com',
            'profession' => $profession->id,
            'password' => '123456'
        ])->assertRedirect(route('users.index'));

        $this->assertCredentials([
            'name' => 'Cristyan',
            'email' => 'cristyan12@mail.com',
            'profession_id' => $profession->id,
            'password' => '123456'
        ]);
    }

    /** @test */
    function the_name_field_is_required()
    {
        $profession = factory(Profession::class)->create();

        $this->from('users')
            ->post(route('users.store'), [
                'name' => '',
                'email' => 'cristyan12@mail.com',
                'profession' => $profession->id,
                'password' => '123456'
            ])
            ->assertRedirect(route('users.store'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_field_is_required()
    {
        $profession = factory(Profession::class)->create();

        $this->from('users')
            ->post(route('users.store'), [
                'name' => 'Cristyan',
                'email' => '',
                'profession' => $profession->id,
                'password' => '123456'
            ])
            ->assertRedirect(route('users.store'))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_field_must_be_unique()
    {
        // $this->withoutExceptionHandling();
        
        factory(User::class)->create([
            'email' => 'cristyan@mail.com',
        ]);

        $profession = factory(Profession::class)->create();

        $this->from('users')
            ->post(route('users.store'), [
                'name' => 'Cristyan',
                'email' => 'cristyan@mail.com',
                'profession' => $profession->id,
                'password' => '123456'
            ])
            ->assertRedirect(route('users.store'))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

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
        $this->withoutExceptionHandling();

        $profession = factory(Profession::class)->create([
            'title' => 'Desarrollador web'
        ]);

        $user = factory(User::class)->create([
            'name' => 'Cristyan Valera',
            'email' => 'cristyan12@mail.com',
            'profession_id' => $profession->id,
        ]);
        
        $response = $this->get(route('users.show', $user))
            ->assertStatus(200)
            ->assertSee('Cristyan Valera')
            ->assertSee('cristyan12@mail.com')
            ->assertSee('Desarrollador web');
    }

    /** @test */
    function it_show_a_default_message_when_list_of_user_is_empty()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get(route('users.index'))
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados');
    }
}
