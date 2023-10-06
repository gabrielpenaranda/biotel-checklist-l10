{{-- CHECKLIST MODEL --}}

@extends('admin.layouts.base')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="container">
        <div class="row mt-3">
            <div class="col-7 offset-1">
                <h4 class="">Modelos de Checklist</h4>
            </div>
            <div class="col-3">
                <a class="btn btn-b-danger btn-sm" href="{{ route('checklist-model.create') }}">Crear Modelo de Checklist</a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-10 offset-1">
                @if (!$checklist_models->isEmpty())
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <th class="text-center text-9">Nombre</th>
                                <th class="text-center text-9">Descripcion</th>
                                <th class="text-center text-9">Activo</th>
                                <th class="text-center text-9">Fecha de creación</th>
                                <th class="text-center text-9">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($checklist_models as $c)
                                    <tr>
                                        <td class="text-9">
                                            {{ $c->name }}
                                        </td>
                                        <td class="text-9">
                                            {{ $c->description }}
                                        </td>
                                        <td class="text-center text-9">
                                            @if ($c->is_active)
                                                Si
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td class="text-center text-9">
                                            @php
                                                echo date_format($c->created_at, 'd/m/Y');
                                            @endphp
                                        </td>
                                        <td class="text-center">
                                            @if (Auth::check())
                                                <form action="{{ route('checklist-model.show-destroy', ['checklist_model' => $c->id]) }}" method='GET'>
                                                    <div class="btn-group">
                                                        @can('checklist-model.edit')
                                                        <a class="btn btn-sm btn-primary" href="{{ route('checklist-model.edit', ['checklist_model' => $c->id]) }}" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        @endcan

                                                        @can('checklist-model.show')
                                                        <a class="btn btn-sm btn-info" href="{{ route('checklist-model.show', ['checklist_model' => $c->id]) }}" title="Ver"><i class="fa-regular fa-eye"></i></a>
                                                        @endcan

                                                        @can('element-model.index')
                                                        <a class="btn btn-sm btn-secondary" href="{{ route('element-model.index', ['checklist_model' => $c->id, 'element_num' => 0]) }}" title="Elementos"><i class="fa-regular fa-rectangle-list"></i></a>
                                                        @endcan

                                                        @can('checklist.create')
                                                        @if ($c->is_active)
                                                            <a class="btn btn-sm btn-danger" href="{{ route('checklist.create', ['checklist_model' => $c->id]) }}" title="Generar"><i class="fa-regular fa-square-plus"></i></a>
                                                        @else
                                                            <a class="btn btn-sm btn-danger disabled" href="#" title="Editar"><i class="fa-regular fa-square-plus"></i></a>
                                                        @endif
                                                        @endcan

                                                        @can('checklist-model.destroy')
                                                        <button class="btn btn-sm btn-dark confirmation" onclick="" title="Eliminar"><i class="fa-regular fa-trash-can"></i></button>
                                                        @endcan
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <div class="container">
                        <div class="row">
                            <div class="col-8 col-offset-2">
                                {!! $checklist_models->render() !!}
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h4 class="">No se encontraron modelos de checklist</h4>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
