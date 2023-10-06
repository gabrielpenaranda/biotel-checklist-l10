<div>
    <div class="container">
        <div class="row mt-3">
            <div class="col-9 offset-1">
                <h5 class="">Usuarios</h5>
            </div>
            <div class="col-1">
                @can('user.create')
                    <a class="btn btn-b-danger btn-sm text-9" href="{{ route('user.create') }}">Nuevo</a>
                @endcan
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-1 offset-1">
                <div class="form-group">
                    <select class="form-control text-8" wire:model="cant">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
            <div class="col-7">
                <div class="form-group">
                    <input type="text" wire:model="search" class="form-control text-8" placeholder="Buscar">
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-10 offset-1">
                @if ($users->count())
                    <table class="table table-striped table-sm">
                        <thead class="thead-dark">
                            <th class="text-center text-8">Email</th>
                            <th class="text-center text-8">Nombre</th>
                            <th class="text-center text-8">C.I.</th>
                            <th class="text-center text-8">Cargo</th>
                            <th class="text-center text-8">Fecha registro</th>
                            <th class="text-center text-8">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $c)
                                @if ($c->id != 1)
                                    @if (!$c->deleted)
                                        <tr>
                                            <th class="text-center text-8">
                                                {{ $c->email }}
                                            </th>
                                            <td class="text-8">
                                                {{ $c->name }}
                                            </td>
                                            <td class="text-center text-8">
                                                {{ $c->identification }}
                                            </td>
                                            <td class="text-8">
                                                {{ $c->position }}
                                            </td>
                                            <td class="text-center text-8">
                                                @php
                                                    echo date_format($c->created_at, 'd/m/Y');
                                                @endphp
                                            </td>

                                            <td class="text-center">
                                                @if (Auth::check())
                                                    <form
                                                        action="{{ route('user.show-destroy', ['user' => $c->id]) }}"
                                                        method='GET'>

                                                        <div class="">
                                                            @can('user.edit')
                                                                <a class="btn btn-sm btn-primary"
                                                                    href="{{ route('user.edit', ['user' => $c->id]) }}"
                                                                    title="Editar"><i
                                                                        class="fa-regular fa-pen-to-square text-8"></i></a>
                                                            @endcan

                                                            @can('user.edit-password')
                                                                <a class="btn btn-sm btn-secondary"
                                                                    href="{{ route('user.edit-password', ['user' => $c->id]) }}"
                                                                    title="Cambiar password"><i
                                                                        class="fa-solid fa-key text-8"></i></a>
                                                            @endcan

                                                            @can('user.edit-permission')
                                                                <a class="btn btn-sm btn-danger"
                                                                    href="{{ route('user.edit-permission', ['user' => $c->id]) }}"
                                                                    title="Asignar permisos"><i
                                                                        class="fa-regular fa-circle-check text-8"></i></a>
                                                                {{-- <a class="btn btn-sm btn-danger disabled" href="#" title="Asignar permisos"><i class="fa-regular fa-circle-check"></i></a> --}}
                                                            @endcan

                                                            @can('user.destroy')
                                                                <button class="btn btn-sm btn-dark confirmation" onclick=""
                                                                    title="Eliminar"><i
                                                                        class="fa-regular fa-trash-can text-8"></i></button>
                                                            @endcan
                                                        </div>

                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No se encontraron usuarios</h4>
                @endif

                @if ($users->hasPages())
                    <div class="container">
                        <div class="row">
                            <div class="col-8 col-offset-2">
                                {!! $users->links() !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
