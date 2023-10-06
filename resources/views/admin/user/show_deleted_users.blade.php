{{-- ELEMENT MODEL --}}

@extends('admin.layouts.base')

@section('styles')
    @parent
@endsection

@section('content')

    <div class="container">
    <div class="row mt-3">
        <div class="col-8 offset-1">
            <h4 class="">Usuarios Eliminados</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-1">
             @if (!$deleted_users->isEmpty())
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center text-9">Email</th>
                    <th class="text-center text-9">Nombre</th>
                    <th class="text-center text-9">C.I.</th>
                    <th class="text-center text-9">Cargo</th>
                    <th class="text-center text-9">Fecha desde</th>
                     <th class="text-center text-9">Fecha hasta</th>
                </thead>
                <tbody>
                    @foreach ($deleted_users as $c)
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
                        <td class="text-center text-9">
                            {{ $c->position }}
                        </td>
                        <td class="text-center text-9">
                            @php
                                echo date('d/m/Y',strtotime($c->date_since));
                            @endphp
                        </td>
                        <td class="text-center text-9">
                            @php
                                echo date('d/m/Y',strtotime($c->date_to));
                            @endphp
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row">
                    <div class="col-8 col-offset-2">
                    {!! $deleted_users->render() !!}
                    </div>
                </div>
            </div>
            @else
                <br>
                <h3 class="text-center">No se encontraron usuarios eliminados</h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
