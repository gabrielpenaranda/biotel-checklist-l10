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
                <h4 class="">Generar Checklist</h4>
            </div>
            <div class="col-2">
                <a class="btn btn-danger btn-sm" href="{{ route('checklist-model.index') }}">Regresar</a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-10 offset-1">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="thead-dark">
                            <th class="text-center text-9">Nombre</th>
                            <th class="text-center text-9">Descripcion</th>
                            <th class="text-center text-9">Activo</th>
                            <th class="text-center text-9">Fecha de creación</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-9">
                                    {{ $checklist_model->name }}
                                </td>
                                <td class="text-9">
                                    {{ $checklist_model->description }}
                                </td>
                                <td class="text-center text-9" colspan="1">
                                    @if ($checklist_model->is_active)
                                        Si
                                    @else
                                        No
                                    @endif
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

        <div class="row mt-2">
            <div class="col-10 offset-1">
                <h5>Vencimiento</h5>
            </div>
        </div>

        <form action="{{ route('checklist.store') }}" method="POST">
            {{ csrf_field() }}

            <div class="row mt-1">
                <div class="col-2 offset-1">
                    <div class="form-group">
                        <label for="days" class="text-9 font-weight-bold">Días</label>
                        <select name="days" id="" class="form-control text-9">
                            @for ($i = 0; $i <= 30; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="hours" class="text-9 font-weight-bold">Horas</label>
                        <select name="hours" id="" class="form-control text-9">
                            @for ($i = 0; $i <= 23; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="minutes" class="text-9 font-weight-bold">Minutos</label>
                        <select name="minutes" id="" class="form-control text-9">
                            @for ($i = 0; $i <= 59; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="priority" class="text-9 font-weight-bold">Proridad</label>
                        <select name="priority" id="" class="form-control text-9">
                            <option value="Inmediata">Inmediata</option>
                            <option value="Urgente">Urgente</option>
                            <option value="Alta">Alta</option>
                            <option value="Intermedia" selected>Intermedia</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                </div>
            </div>



            <input type="hidden" name="checklist_model_id" value="{{ $checklist_model->id }}">

            <div class="row mt-2">
                <div class="col-10 offset-1">
                    @if ($elements)
                        @can('checklist.create')
                            <button type="submit" class="btn btn-primary btn-sm">Generar Checklist</button>
                        @endcan
                    @else
                        <br>
                        <h4 class="text-center">Modelo de checklist no posee elementos. <br> No es posible crear
                            checklist.</h4>
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
