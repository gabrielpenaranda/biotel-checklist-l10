@extends('admin.layouts.base')

@section('title')
{{ $titulo }}
@endsection

@section('styles')
@parent
@endsection

@section('content')
 @php
    use Illuminate\Support\Carbon;
@endphp
<div class="container">

    <div class="row">
        <div class="col-12">
            <br>
            <h4 class="">Reporte de Log</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if (!$logs->isEmpty())
            <div class="table-container">
                <table class="table ">
                    <thead>
                        <th class="text-center text-9">Fecha</th>
                        <th class="text-center text-9">Acción</th>
                        <th class="text-center text-9">Descripción</th>
                        <th class="text-center text-9">Tabla</th>
                        <th class="text-center text-9">ID</th>
                        <th class="text-center text-9">Usuario</th>
                        <th class="text-center text-9">C.I.</th>
                    </thead>
                    <tbody>
                        @foreach ($logs as $l)
                        <tr>
                            <td class="text-9">
                               @php
                                    echo Carbon::parse($l->created_at)->format('d-m-y g:i A');
                                @endphp
                            </td>
                            <td class="text-9">
                                @switch($l->action)
                                    @case('C')
                                        Crear
                                        @break
                                    @case('U')
                                        Actualizar
                                        @break
                                    @case('D')
                                        Eliminar
                                        @break
                                @endswitch
                            </td>
                            <td class="text-9">
                                {{ $l->description }}
                            </td>
                            <td class="text-9">
                                {{ $l->table_name }}
                            </td>
                            <td class="text-9">
                                {{ $l->table_id }}
                            </td>
                            <td class="text-9">
                                {{ $l->user_name }}
                            </td>

                            <td class="text-9">
                                {{ $l->user_id }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container">
                    <div class="row">
                        <div class="col-8 offset-2">
                                {!! $logs->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            @else
            <br>
            <h4 class="">No se encontraron registros para el rango de
                fecha seleccionado.</h4>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
@endsection
