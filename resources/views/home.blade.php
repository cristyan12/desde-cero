@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header lead">
                    <b>Dashboard</b>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 class="display-4">Curso de Laravel 5.5 desde cero</h1>
                    <p class="lead">Por Styde.net</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
