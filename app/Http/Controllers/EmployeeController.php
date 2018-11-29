<?php

namespace App\Http\Controllers;

use App\{Country, Employee, Journal, Position, Profession};
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'DESC')->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $professions = Profession::orderBy('id')->pluck('title', 'id');
        $countries = Country::orderBy('id')->pluck('name', 'id');
        $journalsType = Journal::orderBy('id')->pluck('type', 'id');

        return view('employees.create', compact(
            'professions', 'countries', 'journalsType'
        ));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
