{{-- ELEMENT MODEL --}}

@extends('admin.layouts.base')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="container">
    <div class="row mt-2">
        <div class="col-8 offset-1">
            <h5 class="">Elementos de Modelo de Checklist</h5>
        </div>
        <div class="col-2">
            {{-- <a class="btn btn-secondary btn-sm" href="{{ route('element-model.create', ['checklist_model' => $checklist_model->id]) }}">Crear Elemento</a> --}}
            <a class="btn btn-danger btn-sm" href="{{ route('checklist-model.index') }}">Regresar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-1">
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-8">Nombre</th>
                    <th class="text-center text-8">Descripcion</th>
                    <th class="text-center text-8">Activo</th>
                    <th class="text-center text-8">Fecha de creación</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-8">
                            {{ $checklist_model->name }}
                        </td>
                        <td class="text-8">
                            {{ $checklist_model->description }}
                        </td>
                        <td class="text-center text-8">
                            @if ($checklist_model->is_active)
                                Si
                            @else
                                No
                            @endif
                        </td class="text-8">
                        <td class="text-center text-8">
                            @php
                                echo date_format($checklist_model->created_at, 'd/m/Y');
                            @endphp
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
        </div>
    </div>
    {{-- ****************************************** --}}
    {{-- FORMULARIO DE INCLUSION DE ELEMENT MODEL --}}
    {{-- ****************************************** --}}
    @can('element-model.create')
    @php
        $element_num++;
    @endphp
            <form action="{{ route('element-model.store') }}" method="POST">

                {{ csrf_field() }}

                <input type="hidden" name="checklist_model_id" value="{{ $checklist_model->id  }}">
                <div class="row">
                    <div class="col-9 offset-1">
                        <span class="font-weight-bold">Agregar Nuevo Elemento de Modelo</span>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary btn-sm">Grabar</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 offset-1">
                        <label for="element_number" class="text-8 font-weight-bold">Número en el checklist</label>
                    </div>
                    <div class="col-6">
                        <label for="description" class="text-8 font-weight-bold">Descripción</label>
                    </div>
                    <div class="col-1">
                        <label for="level" class="text-8 font-weight-bold">Nivel</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 offset-1">
                        <div class="form-group">
                            <input type="number" name="element_number" min="1" step="1" class="form-control text-8" value="{{ $element_num }}"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="description" class="form-control text-8" value="" />
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <input type="number" name="level" min="0" step="1" max="1" class="form-control text-8" value=""/>
                        </div>
                    </div>
                </div>

            </form>

      @endcan
    {{-- ****************************************** --}}
    <div class="row">
        <div class="col-10 offset-1">
        @if (!$element_models->isEmpty())
            <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <th class="text-center text-8">Número</th>
                <th class="text-center text-8">Descripción</th>
                <th class="text-center text-8">Acciones</th>
            </thead>
            <tbody>
                @foreach ($element_models as $c)
                <tr>
                    <td class="text-center text-8">
                    {{ $c->element_number }}
                    </td>
                    <td class="text-8">
                        @if ($c->level == 1)
                            <div class="row">
                                <div class="col-11 offset-1">
                                    {{ $c->description }}
                                </div>
                            </div>
                        @else
                            {{ $c->description }}
                        @endif
                    </td>
                    <td class="text-center">
                    @if (Auth::check())
                        <form action="{{ route('element-model.destroy', ['element_model' => $c->id]) }}" method='POST'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="">
                            @can('element-model.edit')
                            <a class="btn btn-sm btn-primary text-8" href="{{ route('element-model.edit', ['element_model' => $c->id, 'checklist_model' => $checklist_model->id, 'element_num', $element_num]) }}" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                            @endcan

                            @can('element-model.destroy')
                            <button class="btn btn-sm btn-dark text-8 confirmation" onclick="" title="Eliminar"><i class="fa-regular fa-trash-can"></i></button>
                            @endcan
                        </div>
                        </form>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
           {{--  <div class="container">
                <div class="row">
                    <div class="col-8 col-offset-2">
                    {!! $element_models->render() !!}
                    </div>
                </div>
            </div> --}}
        @else
            <br>
            <h5 class="text-center">No se encontraron elementos de modelos de checklist</h5>
        @endif
        </div>
    </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
