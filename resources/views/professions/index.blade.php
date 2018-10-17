@extends('layouts.app')

@section('title', 'Lista de usuarios')

@section('content')

<div class="d-flex justify-content-between align-items-end mb-3">
    <h1 class="pb-1 display-4">Listado de profesiones</h1>
    <p>
        <a href="{{ route('professions.create') }}" class="btn btn-outline-primary">
            Nueva profesión
        </a>
    </p>
</div>

@if(! $professions->count() == 0)
    <table class="table table-borderless table-striped table-hover">
        <thead class="bg-dark text-white">
            <th>ID</th>
            <th>Title</th>
            <th>Last updated</th>
            <th colspan="2">
                &nbsp;
            </th>
        </thead>
        <tbody>
            @foreach($professions as $profession)
            <tr>
                <td width="10px">{{ $profession->id }}</td>
                <td>{{ $profession->title }}</td>
                <td>{{ $profession->updated_at->diffForHumans() }}</td>
                <td width="10px">
                    <a href="{{ route('professions.show', $profession) }}" class="btn btn-outline-info btn-sm">Ver</a>
                </td>
                <td width="10px">
                    <a href="{{ route('professions.edit', $profession) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="lead">No hay profesiones registradas aún.</p>
@endif

{{ $professions->render() }}

@endsection