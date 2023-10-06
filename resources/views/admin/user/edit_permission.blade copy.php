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
            <h4 class="">Permisos de Usuario</h4>
        </div>
        <div class="col-2">
            <a class="btn btn-danger btn-sm" href="{{ route('user.index') }}">Regresar</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-5 offset-2">
            <span class="font-weight-bold">{{ $user->name }}</span>
        </div>
    </div>

        @php
            $permission_name = [
                "checklist-model.index" => "Indice",
                "checklist-model.create" => "Crear",
                "checklist-model.edit" => "Editar",
                "checklist-model.show" => "Ver",
                "checklist-model.destroy" => "Eliminar",
                "element-model.index" => "Indice",
                "element-model.create" => "Crear",
                "element-model.edit" => "Editar",
                "element-model.destroy" => "Eliminar",
                "checklist.index" => "Indice",
                "checklist.edit" => "Editar",
                "checklist.create" => "Generar",
                "checklist.show" => "Ver",
                "checklist.first-edit" => "Asignar usuario 1ra evaluación",
                "checklist.second-edit" => "Asignar usuario 2da evaluación",
                "checklist.first-verify-edit" => "Primera verificación de checklist",
                "checklist.second-verify-edit" => "Segunda verificación de checklist",
                "user.index" => "Indice",
                "user.create" => "Crear",
                "user.edit" => "Editar",
                "user.show" => "Ver",
                "user.destroy" => "Eliminar",
                "user.edit-password" => "Cambiar contraseña de usuario",
                "user.edit-permission" => "Editar permisos de usuario",
            ];

            $module_name = [
                "checklist-model.index" => "Modelo de Checklist",
                "checklist-model.create" => "Modelo de Checklist",
                "checklist-model.edit" => "Modelo de Checklist",
                "checklist-model.show" => "Modelo de Checklist",
                "checklist-model.destroy" => "Modelo de Checklist",
                "element-model.index" => "Elemento de Modelo de Checklist",
                "element-model.create" => "Elemento de Modelo de Checklist",
                "element-model.edit" => "Elemento de Modelo de Checklist",
                "element-model.destroy" => "Elemento de Modelo de Checklist",
                "checklist.index" => "Checklists",
                "checklist.create" => "Checklists",
                "checklist.edit" => "Checklists",
                "checklist.show" => "Checklists",
                "checklist.first-edit" => "Checklists",
                "checklist.second-edit" => "Checklists",
                "checklist.first-verify-edit" => "Checklists",
                "checklist.second-verify-edit" => "Checklists",
                "user.index" => "Usuarios",
                "user.create" => "Usuarios",
                "user.edit" => "Usuarios",
                "user.show" => "Usuarios",
                "user.destroy" => "Usuarios",
                "user.edit-password" => "Usuarios",
                "user.edit-permission" => "Usuarios",
            ];

            $module = "";
            $p = false;
        @endphp

<form action="{{ route('user.update-permission', ['user' => $user->id]) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @foreach ($permissions as $p)
            <div class="row">
                <div class="col-5 offset-2">
                    @if ($module != $module_name[$p->name])
                        @php
                            $module = $module_name[$p->name];
                        @endphp
                        <br>
                        <span class="font-weight-bolder">{{ $module }}</span>
                    @endif
                    @if ($user->hasPermissionTo($p->name))
                        @php
                            $hpt = True;
                        @endphp
                    @else
                        @php
                            $hpt = False;
                        @endphp
                    @endif
                    <div class="form-check">
                    <input type="checkbox" name="{{ $p->name }}" class="form-check-input text-9" value="permission" {{ $hpt ? "checked" : "" }} />
                        <label for="{{ $p->name }}" class="form-check-label text-9">
                            {{ $permission_name[$p->name] }}
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    <div class="row mt-4">
        <div class="col-8 offset-2">
            @can('user.edit-permission')
            <button type="submit" class="btn btn-b-primary btn-sm">Actualizar Permisos</button>
            @endcan
        </div>
    </div>
    <br>
    </form>
</div>

@endsection

@section('javascripts')
    @parent
@endsection
