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
            <h5 class="">Modelo de Checklist</h5>
        </div>
        <div class="col-2">
            <a class="btn btn-danger btn-sm text-9" href="{{ route('checklist-model.index') }}">Regresar</a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-10 offset-1">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-8">Nombre</th>
                        <th class="text-center text-8">Descripcion</th>
                        <th class="text-center text-8" >Activo</th>
                         <th class="text-center text-8">Instrucciones</th>
                        <th class="text-center text-8">Fecha de creación</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class=" text-8">
                                {{ $checklist_model->name }}
                            </td>
                            <td class=" text-8">
                                {{ $checklist_model->description }}
                            </td>
                            <td class="text-center text-8" colspan="1">
                                @if ($checklist_model->is_active)
                                    Si
                                @else
                                    No
                                @endif
                            </td>
                            <td class="text-8">
                                {{ $checklist_model->instructions }}
                            </td>
                            <td class="text-center text-8">
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
                        <th class="text-center text-8">Número</th>
                        <th class="text-center text-8">Descripción</th>
                    </thead>
                    <tbody>
                        @foreach ($element_models as $c)
                        <tr>
                            <td class="text-center text-8" style="width: 15%">
                            {{ $c->element_number }}
                            </td>
                            <td class="text-8" style="width: 85%">
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
            <h5 class="text-center">No se encontraron elementos de modelos de checklist</h5>
        @endif
        </div>
    </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
