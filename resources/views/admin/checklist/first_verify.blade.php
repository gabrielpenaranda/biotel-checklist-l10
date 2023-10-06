@extends('admin.layouts.base')

@section('title')
{{ $titulo }}
@endsection

@section('stylesheets')
@parent
@endsection


@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-10">
            <h4 class="">Checklist (1<sup>ra</sup> Verificación)</h4>
        </div>
        <div class="col-2">
            @can('checklist.index')
            <a class="btn btn-danger btn-sm" href="{{ route('checklist.index') }}">Regresar</a>
            @endcan
        </div>
    </div>

    @if ($checklist->verificacion == '0')


    <div class="row mt-2">
        <div class="col-12">
            <h5 class="">Checklist Nº {{ $checklist->id }} </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-9">Nombre</th>
                        <th class="text-center text-9">Status</th>
                        <th class="text-center text-9">Usuario</th>
                        <th class="text-center text-9">Fecha de creación</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="text-9">
                            {{ $checklist->name }}
                        </td>
                        <td class="text-center text-9">
                            @switch($checklist->status)
                                @case('0')
                                    No asignado
                                    @break
                                @case('1')
                                    En proceso
                                    @break
                                @case('2')
                                    Verificado
                                    @break
                            @endswitch
                        </td class="text-9">
                        <td class="text-center text-9">
                            {{ $checklist->name_first }} C.I. {{ $checklist->employee->identification }}
                        </td>
                        <td class="text-center text-9">
                            @php
                                echo date_format($checklist->created_at, 'd/m/Y');
                            @endphp
                        </td>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <table class="table table-stripped table-sm">
                        <thead class="thead-dark">
                            <th class="text-center text-9">Descripción</th>
                            <th class="text-center text-9">Instrucciones</th>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="text-center text-9">
                                   {{ $checklist->description }}
                                </td>
                                <td class="text-9">
                                   {{ $checklist->instructions }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    <form action="{{ route('checklist.first-verify-update', ['checklist' => $checklist->id]) }}" method="POST">

        {{ method_field('PUT') }}

        {{ csrf_field() }}


        <input type="hidden" name="checklist_id" value={{ $checklist->id }}>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <table class="table table-stripped table-sm">
                        <thead class="thead-dark">
                            <th class="text-center text-9">#</th>
                            <th class="text-9">Descripción</th>
                            <th class="text-center text-9">Verificar</th>
                            <th class="text-9">Observaciones</th>
                        </thead>

                        <tbody>
                            @foreach ($elements as $e)
                                @php
                                    $num = (string)$e->element_number;
                                @endphp
                            <tr>
                                <td class="text-center text-9" style="width: 5%">
                                   {{ $e->element_number }}
                                </td>
                                <td class="text-9" style="width: 25%">
                                    @if ($e->level == 1)
                                        <div class="row">
                                            <div class="col-11 offset-1">
                                                {{ $e->description }}
                                            </div>
                                        </div>
                                    @else
                                        {{ $e->description }}
                                    @endif
                                </td>
                                <td class="text-center" style="width: 5%">
                                    <input type="checkbox" name="e{{ $num }}" class="form-check-input text-9" value="column_one" {{ $e->column_one ? "checked" : "" }}>
                                </td>
                                 <td class="" style="width: 65%">
                                    <input type="text" name="column_two{{ $num }}"class="form-control text-9" >
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @can('checklist.first-verify-edit')
                <button type="submit" class="btn btn-primary btn-sm">Completar</button>
                @endcan
            </div>
        </div>
        <br>
    </form>
    @else
        <h3>No es posible cambiar empleado, ya está lista 1<sup>ra</sup> verificación</h3>
    @endif
</div>

@endsection

@section('javascripts')
@parent
@endsection

