@extends('layouts.app')

@section('title', "Nuevo Empleado")

@section('content')
<div class="col-md-8 mx-auto">

    @include('errors.messages')

    <div class="card">
        <div class="card-header lead">
            <b>Nuevo empleado</b>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'employees.store']) !!}

                @include('employees.partials.form')

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection