<div>
    <div class="row mt-3">
        <div class="col-9 offset-1">
            <h5 class="">Modelos de Checklist</h5>
        </div>
        <div class="col-1">
            @can('checklist-model.create')
                <a class="btn btn-b-danger btn-sm text-9" href="{{ route('checklist-model.create') }}">Nuevo</a>
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
        <div class="col-9">
            <div class="form-group">
                <input type="text" wire:model="search" class="form-control text-8" placeholder="Buscar">
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-10 offset-1">
            @if ($checklist_models->count())
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th scope="col" class="text-center text-8">
                            Nombre
                        </th>
                        <th scope="col" class="text-center text-8">
                            Descripción
                        </th>
                        <th scope="col" class="text-center text-8">
                            Activo
                        </th>
                        <th scope="col" class="text-center text-8">
                            Fecha de creación
                        </th>
                        <th scope="col" class="text-center text-8">
                            Acciones
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($checklist_models as $c)
                            <tr>
                                <td class="text-8" wire:click="order('name')">
                                    {{ $c->name }}
                                </td>
                                <td class="text-8">
                                    {{ $c->description }}
                                </td>
                                <td class="text-center text-8">
                                    @if ($c->is_active)
                                        Si
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="text-center text-8">
                                    @php
                                        echo date_format($c->created_at, 'd/m/Y');
                                    @endphp
                                </td>
                                <td class="text-center">
                                    @if (Auth::check())
                                        <form
                                            action="{{ route('checklist-model.show-destroy', ['checklist_model' => $c->id]) }}"
                                            method='GET'>
                                            <div class="">
                                                @can('checklist-model.edit')
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('checklist-model.edit', ['checklist_model' => $c->id]) }}"
                                                        title="Editar"><i class="fa-regular fa-pen-to-square text-8"></i></a>
                                                @endcan

                                                @can('checklist-model.show')
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('checklist-model.show', ['checklist_model' => $c->id]) }}"
                                                        title="Ver"><i class="fa-regular fa-eye text-8"></i></a>
                                                @endcan

                                                @can('element-model.index')
                                                    <a class="btn btn-sm btn-secondary"
                                                        href="{{ route('element-model.index', ['checklist_model' => $c->id, 'element_num' => 0]) }}"
                                                        title="Elementos"><i class="fa-regular fa-rectangle-list text-8"></i></a>
                                                @endcan

                                                @can('checklist.create')
                                                    @if ($c->is_active)
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('checklist.create', ['checklist_model' => $c->id]) }}"
                                                            title="Generar"><i class="fa-regular fa-square-plus text-8"></i></a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger disabled" href="#" title="Editar"><i
                                                                class="fa-regular fa-square-plus text-8"></i></a>
                                                    @endif
                                                @endcan

                                                @can('checklist-model.clone')
                                                    <a class="btn btn-sm btn-success" href="{{ route('checklist-model.show_clone', ['checklist_model' => $c->id]) }}" title="Clonar"><i class="fa-solid fa-c text-8"></i></a>
                                                @endcan

                                                @can('checklist-model.destroy')
                                                    <button class="btn btn-sm btn-dark confirmation" onclick=""
                                                        title="Eliminar"><i class="fa-regular fa-trash-can text-8"></i></button>
                                                @endcan
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h5>No se encontraron modelos de checklist</h5>
            @endif

            @if ($checklist_models->hasPages())
                <div class="container">
                    <div class="row">
                        <div class="col-8 col-offset-2">
                            {!! $checklist_models->links() !!}
                        </div>
                    </div>
                </div>
            @endif
            {{-- @if (!$checklist_models->isEmpty())
                <div class="container">
                    <div class="row">
                        <div class="col-8 col-offset-2">
                            {!! $checklist_models->render() !!}
                        </div>
                    </div>
                </div>
            @else
                <br>
                <h4 class="">No se encontraron modelos de checklist</h4>
            @endif --}}
        </div>
    </div>
</div>
