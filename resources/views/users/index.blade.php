@extends('layouts.app')

@section('title', 'Lista de usuarios')

@section('content')
<h1 class="display-4">Lista de usuarios</h1>
<table class="table table-borderless table-hover">
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
                <a href="#" class="btn btn-outline-info btn-sm">Ver</a>
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
@endsection