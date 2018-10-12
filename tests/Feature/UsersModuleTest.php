<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{User, Profession};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
    function it_loads_the_users_list()
    {
        $response = $this->get('/users')
            ->assertStatus(200)
            ->assertSee('Usuarios');
    }

    /** @test */
    function it_loads_the_user_details()
    {
        $profession = $this->create(Profession::class, ['title' => 'Desarrollador web']);

        $user = $this->create(User::class, [
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
        $response = $this->get(route('users.index'))
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $profession = $this->create(Profession::class, [
            'title' => 'Desarrollador web'
        ]);

        $this->post(route('users.store'), [
            'name' => 'Cristyan',
            'email' => 'cristyan12@mail.com',
            'profession_id' => $profession->id,
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
        $profession = $this->create(Profession::class);

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
        $profession = $this->create(Profession::class);

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
    function the_email_field_must_be_valid_email()
    {
        $profession = $this->create(Profession::class);

        $this->from('users')
            ->post(route('users.store'), [
                'name' => 'Cristyan',
                'email' => 'correo-no-valido',
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
        $this->create(User::class, ['email' => 'cristyan@mail.com']);

        $profession = $this->create(Profession::class);

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
    function it_can_load_the_form_to_update_user()
    {
        $profession = $this->create(Profession::class, ['title' => 'Carpintero']);

        $user = $this->create(User::class, [
            'name' => 'Cristyan',
            'email' => 'cristyan@mail.com',
            'profession_id' => $profession->id
        ]);

        $this->get("users/{$user->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertViewHasAll(['user', 'professions'])
            ->assertSee('Cristyan')
            ->assertSee('cristyan@mail.com')
            ->assertSee('Carpintero');
    }

    /** @test */
    function it_update_the_user()
    {
        $profession = $this->create(Profession::class);

        $user = $this->create(User::class);

        $this->put(route('users.update', $user->id), [
            'name' => 'Cristyan',
            'email' => 'cristyan12@mail.com',
            'profession_id' => $profession->id,
            'password' => '123456'
        ])->assertRedirect(route('users.show', $user));

        $this->assertCredentials([
            'name' => 'Cristyan',
            'email' => 'cristyan12@mail.com',
            'profession_id' => $profession->id,
            'password' => '123456'
        ]);
    }

    /** @test */
    function the_email_must_be_unique_when_updating_a_user()
    {
        // $this->withoutExceptionHandling();
        
        $profession = $this->create(Profession::class);
     
        $this->create(User::class, [
            'email' => 'existing-email@mail.com'
        ]);

        $user = $this->create(User::class, [
            'email' => 'cristyan12@mail.com'
        ]);

        $this->from(route('users.edit', $user->id))
            ->put("users/{$user->id}", [
                'name' => 'Cristyan',
                'email' => 'existing-email@mail.com',
                'profession_id' => $profession->id,
                'password' => '123456'
            ])
            ->assertRedirect(route('users.edit', $user->id))
            ->assertSessionHasErrors(['email']);

        // $this->assertDatabaseMissing('users', ['email' => 'cristyan12@mail.com']);
    }

    /** @test */
    function the_name_field_is_required_when_updating_a_user()
    {
        $profession = $this->create(Profession::class);
        
        $user = $this->create(User::class);

        $this->from(route('users.edit', $user->id))
            ->put("users/{$user->id}", [
                'name' => '',
                'email' => 'cristyan12@mail.com',
                'profession_id' => $profession->id,
                'password' => '123456'
            ])
            ->assertRedirect(route('users.edit', $user->id))
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'cristyan12@mail.com']);
    }

    /** @test */
    function the_email_field_is_required_when_updating_a_user()
    {
        $profession = $this->create(Profession::class);
        
        $user = $this->create(User::class);

        $this->from(route('users.edit', $user->id))
            ->put("users/{$user->id}", [
                'name' => 'Cristyan',
                'email' => '',
                'profession_id' => $profession->id,
                'password' => '123456'
            ])
            ->assertRedirect(route('users.edit', $user->id))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Cristyan']);
    }

    /** @test */
    function the_email_field_is_must_be_valid_when_updating_a_user()
    {
        $profession = $this->create(Profession::class);
        
        $user = $this->create(User::class);

        $this->from(route('users.edit', $user->id))
            ->put("users/{$user->id}", [
                'name' => 'Cristyan',
                'email' => 'correo-no-valido',
                'profession_id' => $profession->id,
                'password' => '123456'
            ])
            ->assertRedirect(route('users.edit', $user->id))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Cristyan']);
    }

    /** @test */
    function the_profession_id_field_is_required_when_updating_a_user()
    {
        $user = $this->create(User::class);

        $this->from(route('users.edit', $user->id))
            ->put("users/{$user->id}", [
                'name' => 'Cristyan',
                'email' => '',
                'profession_id' => '',
                'password' => '123456'
            ])
            ->assertRedirect(route('users.edit', $user->id))
            ->assertSessionHasErrors(['profession_id']);

        $this->assertDatabaseMissing('users', ['name' => 'Cristyan']);
    }

     /** @test */
    function the_password_field_is_optional_when_updating_the_user()
    {
        $this->withoutExceptionHandling();

        $oldPassword = 'CLAVE_ANTERIOR';

        $profession = $this->create(Profession::class);
        
        $user = $this->create(User::class, [
            'password' => bcrypt($oldPassword)
        ]);

        $this->from(route('users.edit', $user->id))
            ->put("users/{$user->id}", [
                'name' => 'Cristyan',
                'email' => 'cristyan12@mail.com',
                'profession_id' => $profession->id,
                'password' => ''
            ])
            ->assertRedirect(route('users.show', $user));

        $this->assertCredentials([
            'name' => 'Cristyan',
            'email' => 'cristyan12@mail.com',
            'password' => $oldPassword
        ]);
    }
}
