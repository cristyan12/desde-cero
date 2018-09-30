@extends('layouts.app')

@section('title', "Crear Usuario")

@section('content')
<div class="col-md-8 mx-auto">

    @include('errors.messages')

    <div class="card">
        <div class="card-header lead">
            <b>Crear Usuario</b>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'users.store']) !!}
                
                @include('users.partials.form')

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection