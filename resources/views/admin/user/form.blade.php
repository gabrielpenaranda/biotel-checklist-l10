@extends('admin.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection


@section('content')
    @include('admin.user._form', ['user' => $user])
@endsection

@section('javascripts')
    @parent
@endsection
