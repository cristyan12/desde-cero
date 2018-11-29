@extends('layouts.app')

@section('title', 'Empleados')

@section('content')

<div class="d-flex justify-content-between align-items-end mb-3">
    <h1 class="pb-1 display-4">Empleados</h1>
    <p>
        <a href="{{ route('employees.create') }}" class="btn btn-outline-primary">
            Nuevo empleado
        </a>
    </p>
</div>

@if(! $employees->count() == 0)
    <table class="table table-borderless table-striped table-hover">
        <thead class="bg-dark text-white">
            <th>ID</th>
        </thead>
        <tbody>

        </tbody>
    </table>
@else
    <p class="lead">No hay empleados registrados aún.</p>
@endif

{{ $employees->render() }}

@endsection