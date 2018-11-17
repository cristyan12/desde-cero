<?php

namespace App\Http\Controllers;

use App\{Employee, Profession};
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

        return view('employees.create', compact('professions'));
    }
}
