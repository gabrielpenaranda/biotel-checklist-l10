{{-- SHOW CHECKLISTS AND ELEMENTS --}}

@extends('admin.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @php
        use Illuminate\Support\Carbon;
    @endphp
    <div class="container-fluid">
    <div class="row mt-3">
        <div class="col-10">
            <h5 class="">Checklist Nº {{ $checklist->id }} </h5>
        </div>
        <div class="col-2">
            <a class="btn btn-danger btn-sm text-9" href="{{ route('checklist.checklists-by-user', ['user' => $user->id]) }}">Regresar</a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-8">Nombre</th>
                        <th class="text-center text-8">Descripcion</th>
                        <th class="text-center text-8">Status</th>
                        <th class="text-center text-8">Fecha de creación</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="text-8">
                            {{ $checklist->name }}
                        </td>
                        <td class="text-8">
                            {{ $checklist->description }}
                        </td>
                        <td class="text-centertext-8">
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
                        </td>
                        <td class="text-center text-8">
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
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-8">Empleado asignado</th>
                        <th class="text-center text-8">Supervisor asignado</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="text-center text-8">
                            @if ($checklist->employee_id == 1)
                                No asignado
                            @else
                                {{ $checklist->name_first }} C.I. {{ $checklist->employee->identification }}
                            @endif
                        </td>
                        <td class="text-center text-8">
                            @if ($checklist->supervisor_id == 1)
                                No asignado
                            @else
                                {{ $checklist->name_second }} C.I. {{ $checklist->supervisor->identification }}
                            @endif
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-8">Fecha 1<sup>ra</sup> Verificación</th>
                        <th class="text-center text-8">Fecha 2<sup>da</sup> Verificación</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center text-8">
                                @if ($checklist->verificacion != "0" )
                                    @php
                                        echo Carbon::parse($checklist->first_date)->format('d-m-y g:i A');
                                    @endphp
                                @endif
                            </td>
                            <td class="text-center text-8">
                                @if ($checklist->verificacion == "2")
                                    @php
                                        echo Carbon::parse($checklist->second_date)->format('d-m-y g:i A');
                                    @endphp
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        @if (!$elements->isEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-8">Número</th>
                        <th class="text-center text-8">Descripción</th>
                        <th class="text-center text-8">
                            1<sup>ra</sup> Verificación
                        </th>
                        <th class="text-center text-8">Observaciones</th>
                        <th class="text-center text-8">
                            2<sup>da</sup> Verificación
                        </th>
                        <th class="text-center text-8">Observaciones</th>
                    </thead>
                    <tbody>
                        @foreach ($elements as $c)
                        <tr>
                            <td class="text-center text-8"  style="width: 5%">
                                {{ $c->element_number }}
                            </td>
                            <td class="text-8">
                                @if ($c->level == 1)
                                    <div class="row">
                                        <div class="col-11 offset-1"  style="width: 25%">
                                            {{ $c->description }}
                                        </div>
                                    </div>
                                @else
                                    {{ $c->description }}
                                @endif
                            </td>
                            <td class="text-center text-8"  style="width: 5%">
                                @if ($c->column_one)
                                    <i class="fa-solid fa-check"></i>
                                @endif
                            </td>
                            <td class="text-8"  style="width: 30%">
                                {{ $c->column_two }}
                            </td>
                            <td class="text-center text-8"  style="width: 5%">
                               @if ($c->column_three)
                                    <i class="fa-solid fa-check"></i>
                               @endif
                            </td>
                            <td class="text-8"  style="width: 30%">
                                {{ $c->column_four }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="container">
                <div class="row">
                    <div class="col-8 col-offset-2">
                    {!! $elements->render() !!}
                    </div>
                </div>
            </div> --}}
        @else
            <br>
            <h4 class="text-center">No se encontraron elementos de checklist</h4>
        @endif
        </div>
    </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
