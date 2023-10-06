{{-- CHECKLIST MODEL --}}

@extends('admin.layouts.base-livewire')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="container">

        @livewire('list-checklist-models')

    </div>
@endsection

@section('javascripts')
    @parent
@endsection
