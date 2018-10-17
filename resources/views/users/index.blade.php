@extends('layouts.app')

@section('title', 'Lista de usuarios')

@section('content')

<div class="d-flex justify-content-between align-items-end mb-3">
    <h1 class="pb-1 display-4">Lista de usuarios</h1>
    <p>
        <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
            Nuevo usuario
        </a>
    </p>
</div>

@if(! $users->count() == 0)
    <table class="table table-borderless table-striped table-hover">
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
            @foreach($users as $user)
            <tr>
                <td width="10px">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
                <td width="10px">
                    <a href="{{ route('users.show', $user) }}" class="btn btn-outline-info btn-sm">Ver</a>
                </td>
                <td width="10px">
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                </td>
                <td width="10px">
                    {!! Form::open(['route' => ['users.delete', $user], 'method' => 'DELETE']) !!}
                        <button class="btn btn-outline-danger btn-sm">
                            Eliminar
                        </button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="lead">No hay usuarios registrados.</p>
@endif

{{ $users->render() }}

@endsection