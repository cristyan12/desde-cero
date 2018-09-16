<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    function it_welcomes_users_with_nickname()
    {
        $this->get('saludos/cristyan/numenor21')
            ->assertStatus(200)
            ->assertSee('Bienvendido Cristyan, tu apodo es numenor21');
    }

    /** @test */
    function it_welcomes_users_without_nickname()
    {
        $this->get('saludos/cristyan')
            ->assertStatus(200)
            ->assertSee('Bienvendido CRISTYAN');   
    }
}
