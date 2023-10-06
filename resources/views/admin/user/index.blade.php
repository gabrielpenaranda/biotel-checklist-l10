{{-- ELEMENT MODEL --}}

@extends('admin.layouts.base-livewire')

@section('styles')
    @parent
@endsection

@section('content')

    @livewire('list-users')

@endsection

@section('scripts')
    @parent
@endsection
