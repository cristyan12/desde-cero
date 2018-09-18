<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        return view('users.index', compact('users'));
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
