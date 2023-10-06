@extends('admin.layouts.base')

@section('title')
{{ $titulo }}
@endsection

@section('stylesheets')
@parent
@endsection


@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-6 offset-2">
            <h4 class="">Cambiar Contraseña</h4>
        </div>
        <div class="col-2">
            @can('user.index')
            <a class="btn btn-danger btn-sm" href="{{ route('user.index') }}">Regresar</a>
            @endcan
        </div>
    </div>

<form action="{{ route('user.update-password', ['user' => $user->id]) }}" method="POST">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="row mt-2">
        <div class="col-8 offset-2">
            <span class="text-9 font-weight-bold">Nombre</span><br>
            <span class="text-9">{{ $user->name }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group">
                <span class="text-9 font-weight-bold">Email</span><br>
                <span class=text-9">{{ $user->email }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group">
                <span class="text-9 font-weight-bold">Cédula de identidad</span><br>
                <span class="text-9">{{ $user->identification }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group">
                <span class="text-9 font-weight-bold">Cargo</span><br>
                <span class="text-9">{{ $user->position }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group">
                <label for="password" class="text-9 font-weight-bold">Contraseña</label>
                <input type="password" name="password" class="form-control text-9" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group">
                <label for="password-confirmation" class="text-9 font-weight-bold">Confirmar contraseña</label>
                <input type="password" name="password-confirmation" class="form-control text-9" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            @can('user.edit-password')
            <button type="submit" class="btn btn-primary btn-sm">Cambiar Password</button>
            @endcan
        </div>
    </div>
    <br>
    </form>
</div>
</div>
@endsection

@section('javascripts')
@parent
@endsection
