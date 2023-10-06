{{-- ELEMENT MODEL --}}

@extends('admin.layouts.base')

@section('styles')
    @parent
@endsection

@section('content')

    <div class="container">
    <div class="row mt-3">
        <div class="col-7 offset-1">
            <h4 class="">Checklists</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-1">
             @if (!$checklists->isEmpty())
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-9">Nº</th>
                    <th class="text-center text-9">Nombre</th>
                    <th class="text-center text-9">Descripcion</th>
                    <th class="text-center text-9">Status</th>
                    <th class="text-center text-9">Fecha de creación</th>
                    <th class="text-center text-9">Acciones</th>
                </thead>
                <tbody>
                    @foreach ($checklists as $c)
                    <tr>
                        <td class="text-9">
                            {{ $c->id }}
                        </td>
                        <td class="text-9">
                            {{ $c->name }}
                        </td>
                        <td class="text-9">
                            {{ $c->description }}
                        </td>
                        <td class="text-center text-9">
                            @switch($c->status)
                                @case('0')
                                    No asignado
                                    @break
                                @case('1')
                                    En Proceso
                                    @break
                                @case('2')
                                    Verificado
                                    @break
                            @endswitch
                        </td>
                        <td class="text-center text-9">
                            @php
                                echo date_format($c->created_at, 'd/m/Y');
                            @endphp
                        </td>
                        <td class="text-center">
                            @if (Auth::check())
                                {{-- <form action="{{ route('element-model.destroy', ['element_model' => $c->id]) }}" method='POST'>
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }} --}}
                                <div class="btn-group">
                                    @can('checklist.show')
                                    <a class="btn btn-sm btn-info" href="{{ route('checklist.show', ['checklist' => $c->id]) }}" title="Ver"><i class="fa-regular fa-eye"></i></a>
                                    @endcan

                                    @if ($c->status != '2' && $c->verificacion == '0')
                                        @can('checklist.first-edit')
                                        <a class="btn btn-sm btn-secondary" href="{{ route('checklist.first-edit', ['checklist' => $c->id]) }}" title="Asignar empleado"><i class="fa-solid fa-1"></i><i class="fa-solid fa-a"></i></a>
                                        @endcan
                                    @endif

                                    @if ($c->status != '2' && $c->verificacion != '2')
                                        @can('checklist.second-edit')
                                        <a class="btn btn-sm btn-danger" href="{{ route('checklist.second-edit', ['checklist' => $c->id]) }}" title="Asignar supervisor"><i class="fa-solid fa-2"></i><i class="fa-solid fa-a"></i></a>
                                        @endcan
                                    @endif

                                    @if ($c->status == '1' && $c->verificacion == '0')
                                        @can('checklist.interchange')
                                            <a class="btn btn-sm btn-warning" href="{{ route('checklist.interchange', ['checklist' => $c->id]) }}" title="Intercambiar usuarios asignados"><i class="fa-solid fa-i"></i></a>
                                        @endcan
                                    @endif

                                    @if ($c->status == '1' && $c->employee_id != 1)
                                        @if ($c->verificacion == '0' && $c->employee_id == auth()->user()->id)
                                            @can('checklist.first-verify-edit')
                                            <a class="btn btn-sm btn-secondary" href="{{ route('checklist.first-verify-edit', ['checklist' => $c->id]) }}" title="1ra Verificación"><i class="fa-solid fa-1"></i><i class="fa-solid fa-v"></i></a>
                                            @endcan
                                        @endif
                                    @endif

                                    @if ($c->status == '1' && $c->supervisor_id != 1)
                                        @if ($c->verificacion == '1' && $c->supervisor_id == auth()->user()->id)
                                            @can('checklist.first-verify-edit')
                                            <a class="btn btn-sm btn-danger" href="{{ route('checklist.second-verify-edit', ['checklist' => $c->id]) }}" title="2da Verificación"><i class="fa-solid fa-2"></i><i class="fa-solid fa-v"></i></a>
                                            @endcan
                                        @endif
                                    @endif

                                   {{--  <button class="btn btn-sm btn-dark confirmation" onclick="" title="Eliminar"><i class="fa-regular fa-trash-can"></i></button> --}}
                                </div>
                                {{-- </form> --}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row">
                    <div class="col-8 col-offset-2">
                    {!! $checklists->render() !!}
                    </div>
                </div>
            </div>
            @else
                <br>
                <h3 class="text-center">No se encontraron checklists</h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
