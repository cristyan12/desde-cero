@extends('layouts.app')

@section('title', "Usuario #{$id}")

@section('content')
    <h1 class="display-4">Usuario #{{ $id }}</h1>
    <p class="lead">Mostrando el detalle del usuario: {{ $id }}</p>
@endsection