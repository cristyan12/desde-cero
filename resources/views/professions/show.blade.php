@extends('layouts.app')

@section('title', "Profesión #{$profession->id}")

@section('content')
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header lead">
            <b>Detalle de la profesión #{{ $profession->id }}</b>
        </div>
        <div class="card-body">
            <p class="lead"><b>Título: </b>{{ $profession->title }}</p>
            <hr>
            <p class="lead"><b>Creada: </b>{{ $profession->created_at->diffForHumans() }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('professions.index') }}" class="btn btn-outline-secondary">
                Volver al listado de Profesiones
            </a>
            <div class="btn-group float-right">
                <a href="#" class="btn btn-outline-warning btn-sm">
                Editar
                </a>
                {{-- {!! Form::open(['route' => ['professions.delete', $profession->id], 'method' => 'DELETE']) !!}
                    <button class="btn btn-outline-danger btn-sm">
                        Eliminar
                    </button>
                {!! Form::close() !!} --}}
            </div>
        </div>
    </div>
</div> 
@endsection