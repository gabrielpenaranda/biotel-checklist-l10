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
        <div class="col-8 offset-1">
            @if ($checklist->supervisor_id == 1)
                <h4 class="">Asignar Supervisor (2<sup>da</sup> Verificación)</h4>
            @else
                <h4 class="">Reasignar Supervisor (2<sup>da</sup> Verificación)</h4>
            @endif
        </div>
        <div class="col-2">
            @can('checklist-model.index')
            <a class="btn btn-danger btn-sm" href="{{ route('checklist.index') }}">Regresar</a>
            @endcan
        </div>
    </div>
    @if ($checklist->verificacion != '2')

    <div class="row mt-2">
        <div class="col-10 offset-1">
            <h5 class="">Checklist Nº {{ $checklist->id }} </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-9">Nombre</th>
                        <th class="text-center text-9">Descripcion</th>
                        <th class="text-center text-9">Status</th>
                        <th class="text-center text-9">Fecha</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="text-9">
                            {{ $checklist->name }}
                        </td>
                        <td class="text-9">
                            {{ $checklist->description }}
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


    <form action="{{ route('checklist.second-update', ['checklist' => $checklist->id]) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}


        <div class="row mt-2">
            <div class="col-10 offset-1">
                <div class="form-group">
                    @if ($checklist->employee_id != 1)
                        <strong class="text-9">Empleado asignado:</strong> {{ $checklist->employee->name }}
                    @endif
                    <br>
                    @if ($checklist->supervisor_id != 1)
                        <strong class="text-9">Supervisor asignado:</strong> {{ $checklist->supervisor->name }}
                    @endif
                    <select name="user_id" class="form-control text-9">
                        @foreach ($users as $u)
                            @if ($u->id != 1 && $checklist->employee_id != $u->id)
                                @if ($checklist->supervisor_id == $u->id)
                                    <option value="{{ $u->id }}" selected>
                                @else
                                    <option value="{{ $u->id }}">
                                @endif
                                {{ $u->name }}
                            @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-10 offset-1">
                @can('checklist.second-edit')
                <button type="submit" class="btn btn-primary btn-sm">Asignar Supervisor</button>
                @endcan
            </div>
        </div>
        <br>
    </form>
    @else
        <h4>No es posible cambiar supervisor, ya está lista 2<sup>da</sup> verificación</h4>
    @endif
</div>

@endsection

@section('javascripts')
@parent
@endsection
