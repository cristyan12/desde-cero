@extends('layouts.app')

@section('title', "Actualizar Usuario")

@section('content')
<div class="col-md-8 mx-auto">

    @include('errors.messages')

    <div class="card">
        <div class="card-header lead">
            <b>Actualizar Usuario</b>
        </div>
        <div class="card-body">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
                
                @include('users.partials.form')

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection