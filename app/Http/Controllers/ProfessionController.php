<?php

namespace App\Http\Controllers;

use App\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::orderBy('id', 'DESC')->paginate(10);

        return view('professions.index', compact('professions'));
    }

    public function create()
    {
        return view('professions.create');
    }

    public function store(Request $request)
    {
        Profession::create($request->validate([
            'title' => 'required|unique:professions,title'
        ], [
            'title.required' => 'El título de la profesión es requerido.',
            'title.unique'   => 'El título de la profesión ya ha sido tomado, por favor elija otro.',
        ]));

        return redirect()->route('professions.index');
    }

    public function show(Profession $profession)
    {
        return view('professions.show', compact('profession'));
    }

    public function edit(Profession $profession)
    {
        return view('professions.edit', compact('profession'));
    }

    public function update(Profession $profession)
    {
        $profession->update(request()->all());

        return redirect()->route('professions.show', $profession);
    }
}
