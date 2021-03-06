<?php

namespace App\Http\Controllers;

use App\{User, Profession};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profession')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $professions = Profession::orderBy('id')->pluck('title', 'id');

        return view('users.create', compact('professions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email',
            'profession_id' => 'required',
            'password'      => ''
        ], [
            'name.required'             => 'El campo Nombre es obligatorio.',
            'email.required'            => 'El campo Email es obligatorio.',
            'email.unique'              => 'El Email ingresado ya está registrado.',
            'profession_id.required'    => 'El campo Profesión es obligatorio.',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'profession_id' => $data['profession_id'],
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
        $professions = Profession::orderBy('id')->pluck('title', 'id');

        return view('users.edit', compact('user', 'professions'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name'          => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'profession_id' => 'required',
            'password'      => ''
        ], [
            'name.required'             => 'El campo Nombre es obligatorio.',
            'email.required'            => 'El campo Email es obligatorio.',
            'email.unique'              => 'El Email ingresado ya está registrado.',
            'profession_id.required'    => 'El campo Profesión es obligatorio.',
            'password.required'         => 'El campo contraseña es obligatorio.',
        ]);

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.show', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
