@extends('layouts.app')

@section('title', "Usuario #{$user->id}")

@section('content')
<div class="card">
    <div class="card-header lead">
        <b>Usuario #{{ $user->id }}</b>
    </div>
    <div class="card-body">
        <p class="lead"><b>Nombre: </b>{{ $user->name }}</p>
        <p class="lead"><b>Email: </b>{{ $user->email }}</p>
        <p class="lead"><b>Profesión: </b>{{ $user->profession->title }}</p>
        <hr>
        <p class="lead"><b>Created at: </b>{{ $user->created_at->diffForHumans() }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
            Volver al listado de usuarios
        </a>
        <div class="btn-group float-right">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm">
            Editar
            </a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-danger btn-sm">
                Eliminar
            </a>
        </div>
    </div>
</div>  
@endsection