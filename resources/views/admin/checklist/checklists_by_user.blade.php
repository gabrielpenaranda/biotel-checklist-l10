{{-- ELEMENT MODEL --}}

@extends('admin.layouts.base')

@section('styles')
@parent
@endsection

@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-8 offset-1">
            <h5 class="">Checklists por Usuario: <small> {{ $user->name }} (C.I. {{ $user->identification }})</small></h5>
        </div>
         <div class="col-2">
            @can('checklist-model.index')
            <a class="btn btn-danger btn-sm" href="{{ route('checklist.checklist-by-users') }}">Regresar</a>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-1">
            @if (!$checklists->isEmpty())
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-8">Nº</th>
                    <th class="text-center text-8">Nombre</th>
                    <th class="text-center text-8">Descripcion</th>
                    <th class="text-center text-8">Status</th>
                    <th class="text-center text-8">Fecha de creación</th>
                    <th class="text-center text-8">Acciones</th>
                </thead>
                <tbody>
                    @foreach ($checklists as $c)
                    <tr>
                        <td class="text-8">
                            {{ $c->id }}
                        </td>
                        <td class="text-8">
                            {{ $c->name }}
                        </td>
                        <td class="text-8">
                            {{ $c->description }}
                        </td>
                        <td class="text-center text-8">
                            @switch($c->status)
                            @case('0')
                            No asignado
                            @break
                            @case('1')
                            En Proceso
                            @break
                            @case('2')
                            Verificado
                            @break
                            @endswitch
                        </td>
                        <td class="text-center text-8">
                            @php
                            echo date_format($c->created_at, 'd/m/Y');
                            @endphp
                        </td>
                        <td class="text-center">
                            @if (Auth::check())
                            {{-- <form action="{{ route('element-model.destroy', ['element_model' => $c->id]) }}"
                            method='POST'>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }} --}}
                            <div class="">
                                @can('checklist.show')
                                    @if ($c->employee_id == $user->id)
                                        <a class="btn btn-sm btn-secondary" href="{{ route('checklist.checklist-by-user', ['checklist' => $c->id, 'user' => $user->id]) }}" title="Ver"><i
                                        class="fa-solid fa-1 text-8"></i></a>
                                    @elseif ($c->supervisor_id == $user->id)
                                        <a class="btn btn-sm btn-danger" href="{{ route('checklist.checklist-by-user', ['checklist' => $c->id, 'user' => $user->id]) }}" title="Ver"><i
                                        class="fa-solid fa-2 text-8"></i></a>
                                    @endif
                                @endcan

                                {{-- <button class="btn btn-sm btn-dark confirmation" onclick="" title="Eliminar"><i class="fa-regular fa-trash-can"></i></button> --}}
                            </div>
                            {{-- </form> --}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row">
                    <div class="col-8 col-offset-2">
                        {!! $checklists->render() !!}
                    </div>
                </div>
            </div>
            @else
            <br>
            <h3 class="text-center">No se encontraron checklists</h3>
            @endif
        </div>
    </div>
    @endsection

    @section('scripts')
    @parent
    @endsection
