@extends('layouts.app')

@section('title', "Crear Usuario")

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header lead">
                <b>Crear Usuario</b>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Contraseña:</label>
                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-outline-primary">
                    Guardar
                </a>
            </div>
        </div>  
    </div>
</div>
@endsection