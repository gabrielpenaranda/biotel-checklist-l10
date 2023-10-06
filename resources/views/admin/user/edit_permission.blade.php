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
                <h4 class="">Permisos de Usuario: <small class="font-weight-bold">{{ $user->name }}</small>
                </h4>
            </div>
            <div class="col-2">
                <a class="btn btn-danger btn-sm" href="{{ route('user.index') }}">Regresar</a>
            </div>
        </div>

        @php

            $app = [
                1 => [
                    'module' => 'Modelo de Checklist',
                    'name' => 'checklist-model-index',
                    'permission' => 'checklist-model.index',
                    'description' => 'Indice',
                ],
                2 => [
                    'module' => 'Modelo de Checklist',
                    'name' => 'checklist-model-create',
                    'permission' => 'checklist-model.create',
                    'description' => 'Crear',
                ],
                3 => [
                    'module' => 'Modelo de Checklist',
                    'name' => 'checklist-model-edit',
                    'permission' => 'checklist-model.edit',
                    'description' => 'Editar',
                ],
                4 => [
                    'module' => 'Modelo de Checklist',
                    'name' => 'checklist-model-show',
                    'permission' => 'checklist-model.show',
                    'description' => 'Ver',
                ],
                5 => [
                    'module' => 'Modelo de Checklist',
                    'name' => 'checklist-model-destroy',
                    'permission' => 'checklist-model.destroy',
                    'description' => 'Eliminar',
                ],
                6 => [
                    'module' => 'Modelo de Checklist',
                    'name' => 'checklist-model-clone',
                    'permission' => 'checklist-model.clone',
                    'description' => 'Clonar',
                ],
                7 => [
                    'module' => 'Elemento de Modelo de Checklist',
                    'name' => 'element-model-index',
                    'permission' => 'element-model.index',
                    'description' => 'Indice',
                ],
                8 => [
                    'module' => 'Elemento de Modelo de Checklist',
                    'name' => 'element-model-create',
                    'permission' => 'element-model.create',
                    'description' => 'Crear',
                ],
                9 => [
                    'module' => 'Elemento de Modelo de Checklist',
                    'name' => 'element-model-edit',
                    'permission' => 'element-model.edit',
                    'description' => 'Editar',
                ],
                10 => [
                    'module' => 'Elemento de Modelo de Checklist',
                    'name' => 'element-model-destroy',
                    'permission' => 'element-model.destroy',
                    'description' => 'Eliminar',
                ],
                11 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-index',
                    'permission' => 'checklist.index',
                    'description' => 'Indice',
                ],
                12 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-create',
                    'permission' => 'checklist.create',
                    'description' => 'Crear',
                ],
                13 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-show',
                    'permission' => 'checklist.show',
                    'description' => 'Ver',
                ],
                14 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-first-edit',
                    'permission' => 'checklist.first-edit',
                    'description' => 'Asignar 1ra Verificación',
                ],
                15 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-second-edit',
                    'permission' => 'checklist.second-edit',
                    'description' => 'Asignar 2da Verificación',
                ],
                16 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-first-verify-edit',
                    'permission' => 'checklist.first-verify-edit',
                    'description' => '1ra Verificación',
                ],
                17 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-second-verify-edit',
                    'permission' => 'checklist.second-verify-edit',
                    'description' => '2da Verificación',
                ],
                18 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-interchange',
                    'permission' => 'checklist.interchange',
                    'description' => 'Intercambiar Usuarios Verificación',
                ],
                19 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-checklist-by-user',
                    'permission' => 'checklist.checklist-by-user',
                    'description' => 'Listado por Usuarios',
                ],
                20 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-pdf',
                    'permission' => 'checklist.pdf',
                    'description' => 'Generar PDF',
                ],
                21 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-expired',
                    'permission' => 'checklist.expired',
                    'description' => 'Listar Checklists Vencidos',
                ],
                22 => [
                    'module' => 'Checklist',
                    'name' => 'checklist-enable',
                    'permission' => 'checklist.enable',
                    'description' => 'Habilitar Checklist',
                ],
                23 => [
                    'module' => 'Usuarios',
                    'name' => 'user-index',
                    'permission' => 'user.index',
                    'description' => 'Indice',
                ],
                24 => [
                    'module' => 'Usuarios',
                    'name' => 'user-create',
                    'permission' => 'user.create',
                    'description' => 'Crear',
                ],
                25 => [
                    'module' => 'Usuarios',
                    'name' => 'user-edit',
                    'permission' => 'user.edit',
                    'description' => 'Editar',
                ],
                26 => [
                    'module' => 'Usuarios',
                    'name' => 'user-destroy',
                    'permission' => 'user.destroy',
                    'description' => 'Eliminar',
                ],
                27 => [
                    'module' => 'Usuarios',
                    'name' => 'user-edit-password',
                    'permission' => 'user.edit-password',
                    'description' => 'Cambiar Password',
                ],
                28 => [
                    'module' => 'Usuarios',
                    'name' => 'user-edit-permission',
                    'permission' => 'user.edit-permission',
                    'description' => 'Editar Permisos',
                ],
                29 => [
                    'module' => 'Usuarios',
                    'name' => 'user-show-deleted-user',
                    'permission' => 'user.show-deleted-user',
                    'description' => 'Listar usuarios eliminados',
                ],
                30 => [
                    'module' => 'Usuarios',
                    'name' => 'user-list-all-users',
                    'permission' => 'user.list-all-users',
                    'description' => 'Listar checklists de todos los usuarios',
                ],
                31 => [
                    'module' => 'Log',
                    'name' => 'log-show',
                    'permission' => 'log.show',
                    'description' => 'Ver Log',
                ],
            ];

            $module = '';

        @endphp

        <form action="{{ route('user.update-permission', ['user' => $user->id]) }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @for ($i = 1; $i <= 31; $i++)
                @if ($module != $app[$i]['module'])
                    @php
                        $module = $app[$i]['module'];
                    @endphp
                    <div class="row mt-2">
                        <div class="col-5 offset-2">
                            <span class="font-weight-bold text-9">{{ $module }}</span>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-5 offset-2">
                        <div class="form-check">
                            <input type="checkbox" name="{{ $app[$i]['name'] }}" class="form-check-input text-9"
                                value="permission"
                                {{ $user->hasPermissionTo($app[$i]['permission']) ? 'checked' : '' }} />
                            <label for="{{ $app[$i]['name'] }}" class="form-check-label text-9">
                                {{ $app[$i]['description'] }}
                            </label>
                        </div>
                    </div>
                </div>
            @endfor

            <div class="row mt-4">
                <div class="col-8 offset-2">
                    @can('user.edit-permission')
                        <button type="submit" class="btn btn-b-primary btn-sm">Actualizar Permisos</button>
                    @endcan
                </div>
            </div>
        </form>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
