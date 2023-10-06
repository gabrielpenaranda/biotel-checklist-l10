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
            @if ($checklist_model->exists)
                <h4 class="">Editar Modelo de Checklist</h4>
                <form action="{{ route('checklist-model.update', ['checklist_model' => $checklist_model->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <h4 class="">Crear Modelo de Checklist</h4>
                <form action="{{ route('checklist-model.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="col-2">
            <a class="btn btn-danger btn-sm" href="{{ route('checklist-model.index') }}">Regresar</a>
        </div>
    </div>

    @if ($checklist_model->exists)
        <input type="hidden" name="checklist_model_id" value="{{ $checklist_model->id }}">
    @endif

    <div class="row mt-2">
        <div class="col-8 offset-2">
            <div class="form-group">
                <label for="name" class="text-9 font-weight-bold">Nombre</label>
                <input type="text" name="name" class="form-control text-9" value="{{ $checklist_model->exists ? $checklist_model->name : old('name') }}" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group">
                <label for="description" class="text-9 font-weight-bold">Descripción</label>
                <textarea name="description" class="form-control text-9" >{{ $checklist_model->exists ? $checklist_model->description : old('description') }}</textarea>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-check">
                @if ($checklist_model->exists)
                    <input type="checkbox" name="is_active" class="form-check-input text-9" value="is_active" {{ $checklist_model->is_active ? "checked" : "" }} />
                    <label for="is_active" class="form-check-label text-9 font-weight-bold">
                        Activo
                    </label>
                @else
                    <input type="checkbox" name="is_active" class="form-check-input text-9t" value="is_active" />
                    <label for="is_active" class="form-check-label text-9 font-weight-bold">
                        Activo
                    </label>
                @endif
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group">
                <label for="instructions" class="text-9 font-weight-bold">Instrucciones de uso</label>
                <textarea name="instructions" class="form-control text-9" >{{ $checklist_model->exists ? $checklist_model->instructions : old('instructions') }}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            @if($checklist_model->exists)
                @can('checklist-model.edit')
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                @endcan
            @else
                @can('checklist-model.create')
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
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
