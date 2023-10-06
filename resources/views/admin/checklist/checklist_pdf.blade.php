@extends('admin.layouts.pdf')


@section('content')
    <div class="container">
    <div class="row mt-3">
        <div class="col-9">
            <h5 class="">Checklist Nº {{ $data['checklist_id'] }} </h5>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
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
                        {{ $data['checklist_name'] }}
                    </td>
                    <td class="text-8">
                        {{ $data['checklist_description'] }}
                    </td>
                    <td class="text-center text-8">
                        {{ $data['checklist_status'] }}
                    </td>
                    <td class="text-center text-8">
                        {{ $data['checklist_created_at'] }}
                    </td>
                </tbody>
            </table>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-8" style="width: 50%">Empleado asignado</th>
                    <th class="text-center text-8" style="width: 50%">Supervisor asignado</th>
                </thead>
                <tbody>
                    <tr>
                    <td class="text-center text-8" style="width: 50%">
                        {{ $data['checklist_employee'] }}
                    </td>
                    <td class="text-center text-8" style="width: 50%">
                        {{ $data['checklist_supervisor'] }}
                    </td>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-8" style="width: 50%">Fecha 1<sup>ra</sup> Verificación</th>
                    <th class="text-center text-8" style="width: 50%">Fecha 2<sup>da</sup> Verificación</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center text-8" style="width: 50%">
                                {{ $data['checklist_first_date'] }}
                        </td>
                        <td class="text-center text-8" style="width: 50%">
                                {{ $data['checklist_second_date'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-8">#</th>
                    <th class="text-center text-8">Descripción</th>
                    <th class="text-center text-8">
                        1<sup>ra</sup>
                    </th>
                    <th class="text-center text-8">Observaciones</th>
                    <th class="text-center text-8">
                        2<sup>da</sup>
                    </th>
                    <th class="text-center text-8">Observaciones</th>
                </thead>
                <tbody>
                    @foreach ($elements as $c)
                    <tr>
                        <td class="text-center text-8" style="width: 5%">
                            {{ $c->element_number }}
                        </td>
                        <td class="text-8"   style="width: 25%">
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
                        <td class="text-center text-8" style="width: 5%">
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
    </div>
    </div>
@endsection
