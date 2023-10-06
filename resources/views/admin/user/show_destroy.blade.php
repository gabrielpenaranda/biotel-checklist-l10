@extends('admin.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('content')


<div class="container">
    <div class="row mt-3">
        <div class="col-8 offset-1">
            <h4 class="">Usuario</h4>
        </div>
        <div class="col-2">
            @can('user.index')
            <a class="btn btn-danger btn-sm" href="{{ route('user.index') }}">Regresar</a>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-1">
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-9">Email</th>
                    <th class="text-center text-9">Nombre</th>
                    <th class="text-center text-9">C.I.</th>
                    <th class="text-center text-9">Cargo</th>
                    <th class="text-center text-9">Fecha registro</th>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center text-9">
                            {{ $user->email }}
                        </th>
                        <td class="text-9">
                            {{ $user->name }}
                        </td>
                        <td class="text-center text-9">
                            {{ $user->identification }}
                        </td>
                        <td class="text-9">
                            {{ $user->position }}
                        </td>
                        <td class="text-center text-9">
                            @php
                                echo date_format($user->created_at, 'd/m/Y');
                            @endphp
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="row">
            <div class="col-2 offset-1">
                @can('user.destroy')
                <button type="submit" class="btn btn-primary btn-sm">Eliminar Usuario</button>
                @endcan
            </div>
        </div>
    </form>


</div>
@endsection
