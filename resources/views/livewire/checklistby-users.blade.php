<div>
    <div class="container">
        <div class="row mt-3">
            <div class="col-8 offset-1">
                <h5 class="">Checklists por usuario</h5>
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

        <div class="row">
            <div class="col-10 offset-1">
                @if (!$users->isEmpty())
                    <table class="table table-striped table-sm">
                        <thead class="thead-dark">
                            <th class="text-center text-8">Email</th>
                            <th class="text-center text-8">Nombre</th>
                            <th class="text-center text-8">C.I.</th>
                            <th class="text-center text-8">Cargo</th>
                            <th class="text-center text-8">1V</th>
                            <th class="text-center text-8">2V</th>
                            <th class="text-center text-8">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $c)
                                @if ($c->id != 1)
                                    @if ($c->first != 0 || $c->second != 0)
                                        <tr>
                                            <th class="text-center text-8">
                                                {{ $c->email }}
                                            </th>
                                            <td class="text-9">
                                                {{ $c->name }}
                                            </td>
                                            <td class="text-center text-8">
                                                {{ $c->identification }}
                                            </td>
                                            <td class="text-8">
                                                {{ $c->position }}
                                            </td>

                                            <td class="text-center">
                                                <span class="badge bg-secondary text-white">
                                                    {{ $c->first }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <span class="badge bg-danger text-white">
                                                    {{ $c->second }}
                                                </span>
                                            </td>



                                            <td class="text-center">
                                                @if (Auth::check())
                                                    <form
                                                        action="{{ route('user.show-destroy', ['user' => $c->id]) }}"
                                                        method='GET'>

                                                        <div class="">

                                                            @can('checklist.checklist-by-user')
                                                                <a class="btn btn-sm btn-info"
                                                                    href="{{ route('checklist.checklists-by-user', ['user' => $c->id]) }}"
                                                                    title="Ver"><i class="fa-regular fa-eye text-8"></i></a>
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
                    <div class="container">
                        <div class="row">
                            <div class="col-8 col-offset-2">
                                {!! $users->links() !!}
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="text-center">No se encontraron usuarios</h3>
                @endif
            </div>
        </div>
    </div>
