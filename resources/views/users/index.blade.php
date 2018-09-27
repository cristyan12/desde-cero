@extends('layouts.app')

@section('title', 'Lista de usuarios')

@section('content')

@if($users->count() == 0)
<h1 class="display-4">No hay usuarios registrados</h1>
@else

<h1 class="display-4">Lista de usuarios</h1>

<table class="table table-borderless table-sm table-hover">
    <thead class="bg-dark text-white">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Last updated</th>
        <th colspan="3">
            &nbsp;
        </th>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td width="10px">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->updated_at->diffForHumans() }}</td>
            <td width="10px">
                <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info btn-sm">Ver</a>
            </td>
            <td width="10px">
                <a href="#" class="btn btn-outline-warning btn-sm">Editar</a>
            </td>
            <td width="10px">
                <a href="#" class="btn btn-outline-danger btn-sm">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

{{ $users->render() }}

@endsection