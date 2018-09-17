<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return 'Crear usuario';
    }

    public function show($id)
    {
        return view('users.show', compact('id'));
    }

    public function edit($id)
    {
        return "Editando usuario: {$id}";
    }
}
