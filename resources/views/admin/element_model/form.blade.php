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
            <div class="col-6 offset-3">
                @if ($element_model->exists)
                    <h4 class="">Editar Elemento Modelo</h4>
                    <form
                        action="{{ route('element-model.update', ['element_model' => $element_model->id, 'element_num' => $element_num]) }}"
                        method="POST">
                        {{ method_field('PUT') }}
                    @else
                        <h4 class="">Crear Elemento Modelo</h4>
                        <form action="{{ route('element-model.store') }}" method="POST">
                @endif

                {{ csrf_field() }}
            </div>
            <div class="col-2">
                <a class="btn btn-danger btn-sm"
                    href="{{ route('element-model.index', ['checklist_model' => $checklist_model->id, 'element_num' => $element_num]) }}">Regresar</a>
            </div>
        </div>

        <input type="hidden" name="checklist_model_id" value="{{ $checklist_model->id }}">
        <input type="hidden" name="element_num" value="{{ $element_num }}">

        <div class="row mt-2">
            <div class="col-8 offset-2">
                <div class="form-group">
                    <label for="description" class="text-9 font-weight-bold">Descripción</label>
                    <input type="text" name="description" class="form-control text-9"
                        value="{{ $element_model->exists ? $element_model->description : old('description') }}" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group">
                    <label for="element_number" class="text-9 font-weight-bold">Número en el checklist</label>
                    <input type="number" name="element_number" min="1" step="1" class="form-control text-9"
                        value="{{ $element_model->exists ? $element_model->element_number : old('element_number') }}" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group">
                    <label for="element_number" class="text-9 font-weight-bold">Nivel</label>
                    <input type="number" name="level" min="0" step="1" max="1"
                        class="form-control text-9"
                        value="{{ $element_model->exists ? $element_model->level : old('level') }}" />
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-8 offset-2">
                @if ($element_model->exists)
                    @can('element-model.edit')
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    @endcan
                @else
                    @can('element-model.create')
                        <button type="submit" class="btn btn-primary btn-sm">Grabar</button>
                    @endcan
                @endif
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
