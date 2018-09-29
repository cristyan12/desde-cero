<?php

namespace App\Http\Controllers;

use App\{User, Profession};
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profession')
            ->orderBy('id')
            ->paginate(10);
        
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $professions = Profession::get();

        return view('users.create', compact('professions'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'profession' => 'required',
            'password' => ''
        ], [
            'name.required'             => 'El campo Nombre es obligatorio.',
            'email.required'            => 'El campo Email es obligatorio.',
            'profession.required'    => 'El campo Profesión es obligatorio.',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'profession_id' => $data['profession'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return "Editando usuario: {$user->name}";
    }
}
