@extends('layouts.app')

@section('title', "Crear Profesión")

@section('content')
<div class="col-md-8 mx-auto">

    @include('errors.messages')

    <div class="card">
        <div class="card-header lead">
            <b>Crear nueva profesión</b>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'professions.store']) !!}
                
                @include('professions.partials.form')

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection