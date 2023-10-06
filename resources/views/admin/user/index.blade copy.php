{{-- ELEMENT MODEL --}}

@extends('admin.layouts.base')

@section('styles')
    @parent
@endsection

@section('content')

    <div class="container">
    <div class="row mt-3">
        <div class="col-8 offset-1">
            <h4 class="">Usuarios</h4>
        </div>
        <div class="col-2">
            <a class="btn btn-b-danger btn-sm" href="{{ route('user.create') }}" >Crear Usuario</a>
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-1">
             @if (!$users->isEmpty())
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-9">Email</th>
                    <th class="text-center text-9">Nombre</th>
                    <th class="text-center text-9">C.I.</th>
                    <th class="text-center text-9">Cargo</th>
                    <th class="text-center text-9">Fecha registro</th>
                    <th class="text-center text-9">Acciones</th>
                </thead>
                <tbody>
                    @foreach ($users as $c)
                    @if ($c->id != 1)
                    <tr>
                        <th class="text-center text-9">
                            {{ $c->email }}
                        </th>
                        <td class="text-9">
                            {{ $c->name }}
                        </td>
                        <td class="text-center text-9">
                            {{ $c->identification }}
                        </td>
                        <td class="text-9">
                            {{ $c->position }}
                        </td>
                        <td class="text-center text-9">
                            @php
                                echo date_format($c->created_at, 'd/m/Y');
                            @endphp
                        </td>

                        <td class="text-center">
                            @if (Auth::check())
                                <form action="{{ route('user.show-destroy', ['user' => $c->id]) }}" method='GET'>

                                <div class="btn-group">
                                    @can('user.edit')
                                    <a class="btn btn-sm btn-primary" href="{{ route('user.edit', ['user' => $c->id]) }}" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                    @endcan

                                    {{-- @can('user.show')
                                    <a class="btn btn-sm btn-info" href="{{ route('user.show', ['user' => $c->id]) }}" title="Ver"><i class="fa-regular fa-eye"></i></a>
                                    @endcan --}}

                                    @can('user.edit-password')
                                    <a class="btn btn-sm btn-secondary" href="{{ route('user.edit-password', ['user' => $c->id]) }}" title="Cambiar password"><i class="fa-solid fa-key"></i></a>
                                    @endcan

                                    @can('user.edit-permission')
                                    <a class="btn btn-sm btn-danger" href="{{ route('user.edit-permission', ['user' => $c->id]) }}" title="Asignar permisos"><i class="fa-regular fa-circle-check"></i></a>
                                    {{-- <a class="btn btn-sm btn-danger disabled" href="#" title="Asignar permisos"><i class="fa-regular fa-circle-check"></i></a> --}}
                                    @endcan

                                    @can('user.destroy')
                                    <button class="btn btn-sm btn-dark confirmation" onclick="" title="Eliminar"><i class="fa-regular fa-trash-can"></i></button>
                                    @endcan
                                </div>

                                </form>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row">
                    <div class="col-8 col-offset-2">
                    {!! $users->render() !!}
                    </div>
                </div>
            </div>
            @else
                <br>
                <h3 class="text-center">No se encontraron usuarios</h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
