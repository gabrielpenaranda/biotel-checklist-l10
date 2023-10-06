{{-- ELEMENT MODEL --}}

@extends('admin.layouts.base')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <br>
    <div class="container">
    <div class="row">
        <div class="col-8 offset-1">
            <h4 class="">Modelo de Checklist</h4>
        </div>
        <div class="col-2">
            @can('checklist-model.index')
            <a class="btn btn-danger btn-sm" href="{{ route('checklist-model.index') }}">Regresar</a>
            @endcan
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-10 offset-1">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-9">Nombre</th>
                        <th class="text-center text-9">Descripcion</th>
                        <th class="text-center text-9" >Activo</th>
                         <th class="text-center text-9">Instrucciones</th>
                        <th class="text-center text-9">Fecha de creación</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class=" text-9">
                                {{ $checklist_model->name }}
                            </td>
                            <td class=" text-9">
                                {{ $checklist_model->description }}
                            </td>
                            <td class="text-center text-9" colspan="1">
                                @if ($checklist_model->is_active)
                                    Si
                                @else
                                    No
                                @endif
                            </td>
                            <td class="text-9">
                                {{ $checklist_model->instructions }}
                            </td>
                            <td class="text-center text-9">
                                @php
                                    echo date_format($checklist_model->created_at, 'd/m/Y');
                                @endphp
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-10 offset-1">
        @if (!$element_models->isEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-9">Número</th>
                        <th class="text-center text-9">Descripción</th>
                    </thead>
                    <tbody>
                        @foreach ($element_models as $c)
                        <tr>
                            <td class="text-center text-8">
                            {{ $c->element_number }}
                            </td>
                            <td class="text-8">
                            {{ $c->description }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="container">
            {{--     <div class="row">
                    <div class="col-8 col-offset-2">
                    {!! $element_models->render() !!}
                    </div>
                </div> --}}
            </div>
        @else
            <br>
            <h3 class="text-center">No se encontraron elementos de modelos de checklist</h3>
        @endif
        </div>
    </div>

    <form action="{{ route('checklist-model.destroy', ['checklist_model' => $checklist_model->id]) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <div class="row">
            <div class="col-3 offset-1">
                @can('checklist-model.destroy')
                <button type="submit" class="btn btn-primary btn-sm">Eliminar Modelo de Checklist</button>
                @endcan
            </div>
        </div>
    </form>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
