<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function greetings($name, $nickname)
    {
        $name = ucfirst($name);

        return "Bienvendido {$name}, tu apodo es {$nickname}";
    }

    public function withoutNickname($name)
    {
        $name = ucfirst($name);

        return "Bienvendido {$name}";
    }
}
