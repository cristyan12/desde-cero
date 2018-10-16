@extends('layouts.app')

@section('title', "Actualizar Profesión")

@section('content')
<div class="col-md-8 mx-auto">

    @include('errors.messages')

    <div class="card">
        <div class="card-header lead">
            <b>Actualizar Profesión</b>
        </div>
        <div class="card-body">
            {!! Form::model($profession, ['route' => ['professions.update', $profession], 'method' => 'PUT']) !!}
                
                @include('professions.partials.form')

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection