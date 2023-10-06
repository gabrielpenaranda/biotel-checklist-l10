<div>
    @php
        use Illuminate\Support\Carbon;
        $today = Carbon::now();
    @endphp
    <div class="row mt-3">
        <div class="col-7 offset-1">
            <h5 class="">Checklists</h5>
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
        <div class="col-2">
            <div class="form-group">
                <select class="form-control text-8" wire:model="status">
                    <option value="3">Todos</option>
                    <option value="0">No asignado</option>
                    <option value="1">En Proceso</option>
                    <option value="2">Verificado</option>
                </select>
            </div>
        </div>
        <div class="col-7">
            <div class="form-group">
                @if ($status == 3)
                    <input type="text" wire:model="search" class="form-control text-8" placeholder="Buscar">
                @else
                    <input type="hidden" class="form-control disabled" placeholder="Buscar">
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-10 offset-1">
            @if ($checklists->count())
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <th class="text-center text-8">Nº</th>
                        <th class="text-center text-8">Nombre</th>
                        <th class="text-center text-8">Descripcion</th>
                        <th class="text-center text-8">Prioridad</th>
                        <th class="text-center text-8">Status</th>
                        <th class="text-center text-8">Fecha de creación</th>
                        <th class="text-center text-8">Fecha de vencimiento</th>
                        <th class="text-center text-8">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($checklists as $c)
                            @if ($c->enabled)
                                @if (auth()->user()->can('checklist.index'))
                                    <tr>
                                        <td class="text-8">
                                            {{ $c->id }}
                                        </td>
                                        <td class="text-8">
                                            {{ $c->name }}
                                        </td>
                                        <td class="text-8">
                                            {{ $c->description }}
                                        </td>
                                        @switch($c->priority)
                                            @case('Inmediata')
                                                @php
                                                    $class = 'badge bg-secondary';
                                                @endphp
                                            @break

                                            @case('Urgente')
                                                @php
                                                    $class = 'badge bg-danger';
                                                @endphp
                                            @break

                                            @case('Alta')
                                                @php
                                                    $class = 'badge bg-warning';
                                                @endphp
                                            @break

                                            @case('Intermedia')
                                                @php
                                                    $class = 'badge bg-info';
                                                @endphp
                                            @break

                                            @case('Baja')
                                                @php
                                                    $class = 'badge bg-success';
                                                @endphp
                                            @break

                                            @default
                                        @endswitch
                                        <td class="text-center text-8">
                                            <span class="{{ $class }}">
                                                {{ $c->priority }}
                                            </span>
                                        </td>
                                        <td class="text-center text-8">
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
                                        <td class="text-center text-8">
                                            @php
                                                echo date_format($c->created_at, 'd/m/Y');
                                            @endphp
                                        </td>
                                        <td class="text-center text-8">
                                            @if ($c->employee_id != 1)
                                                @php
                                                    echo Carbon::parse($c->expiration)->format('d/m/Y g:i A');
                                                @endphp
                                                @if ($today->greaterThanOrEqualTo($c->expiration) && $c->verificacion != '2')
                                                    <br>
                                                    <span class="badge badge-warning">
                                                        Vencido
                                                    </span>
                                                @endif
                                            @else
                                                Fecha no generada
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if (Auth::check())
                                                {{-- <form action="{{ route('element-model.destroy', ['element_model' => $c->id]) }}" method='POST'>
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }} --}}
                                                <div class="">
                                                    @can('checklist.show')
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('checklist.show', ['checklist' => $c->id]) }}"
                                                            title="Ver"><i class="fa-regular fa-eye text-8"></i></a>
                                                    @endcan

                                                    @if ($c->status != '2' && $c->verificacion == '0')
                                                        @can('checklist.first-edit')
                                                            <a class="btn btn-sm btn-secondary"
                                                                href="{{ route('checklist.first-edit', ['checklist' => $c->id]) }}"
                                                                title="Asignar empleado"><i
                                                                    class="fa-solid fa-1 text-8"></i><i
                                                                    class="fa-solid fa-a text-8"></i></a>
                                                        @endcan
                                                    @endif

                                                    @if ($c->status != '2' && $c->verificacion != '2')
                                                        @can('checklist.second-edit')
                                                            <a class="btn btn-sm btn-danger"
                                                                href="{{ route('checklist.second-edit', ['checklist' => $c->id]) }}"
                                                                title="Asignar supervisor"><i
                                                                    class="fa-solid fa-2 text-8"></i><i
                                                                    class="fa-solid fa-a text-8"></i></a>
                                                        @endcan
                                                    @endif

                                                    @if ($c->status == '1' && $c->verificacion == '0')
                                                        @can('checklist.interchange')
                                                            <a class="btn btn-sm btn-warning"
                                                                href="{{ route('checklist.interchange', ['checklist' => $c->id]) }}"
                                                                title="Intercambiar usuarios asignados"><i
                                                                    class="fa-solid fa-i text-8"></i></a>
                                                        @endcan
                                                    @endif

                                                    @if ($c->status == '1' && $c->employee_id != 1)
                                                        @if ($c->verificacion == '0' && $c->employee_id == auth()->user()->id)
                                                            @can('checklist.first-verify-edit')
                                                                <a class="btn btn-sm btn-secondary"
                                                                    href="{{ route('checklist.first-verify-edit', ['checklist' => $c->id]) }}"
                                                                    title="1ra Verificación"><i
                                                                        class="fa-solid fa-1 text-8"></i><i
                                                                        class="fa-solid fa-v text-8"></i></a>
                                                            @endcan
                                                        @endif
                                                    @endif


                                                    @if ($c->status == '1' && $c->supervisor_id != 1)
                                                        @if ($c->verificacion == '1' && $c->supervisor_id == auth()->user()->id)
                                                            @can('checklist.second-verify-edit')
                                                                <a class="btn btn-sm btn-danger"
                                                                    href="{{ route('checklist.second-verify-edit', ['checklist' => $c->id]) }}"
                                                                    title="2da Verificación"><i
                                                                        class="fa-solid fa-2 text-8"></i><i
                                                                        class="fa-solid fa-v text-8"></i></a>
                                                            @endcan
                                                        @endif
                                                    @endif

                                                    {{-- <button class="btn btn-sm btn-dark confirmation" onclick="" title="Eliminar"><i class="fa-regular fa-trash-can"></i></button> --}}
                                                </div>
                                                {{-- </form> --}}
                                            @endif
                                        </td>
                                    </tr>
                                @elseif ($c->employee_id == auth()->user()->id || $c->supervidor_id == auth()->user()->id)
                                    <tr>
                                        <td class="text-8">
                                            {{ $c->id }}
                                        </td>
                                        <td class="text-8">
                                            {{ $c->name }}
                                        </td>
                                        <td class="text-8">
                                            {{ $c->description }}
                                        </td>
                                        @switch($c->priority)
                                            @case('Inmediata')
                                                @php
                                                    $class = 'badge bg-secondary';
                                                @endphp
                                            @break

                                            @case('Urgente')
                                                @php
                                                    $class = 'badge bg-danger';
                                                @endphp
                                            @break

                                            @case('Alta')
                                                @php
                                                    $class = 'badge bg-warning';
                                                @endphp
                                            @break

                                            @case('Intermedia')
                                                @php
                                                    $class = 'badge bg-info';
                                                @endphp
                                            @break

                                            @case('Baja')
                                                @php
                                                    $class = 'badge bg-success';
                                                @endphp
                                            @break

                                            @default
                                        @endswitch
                                        <td class="text-center text-8">
                                            <span class="{{ $class }}">
                                                {{ $c->priority }}
                                            </span>
                                        </td>
                                        <td class="text-center text-8">
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
                                        <td class="text-center text-8">
                                            @php
                                                echo date_format($c->created_at, 'd/m/Y');
                                            @endphp
                                        </td>
                                        <td class="text-center text-8">
                                            @if ($c->employee_id != 1)
                                                @php
                                                    echo Carbon::parse($c->expiration)->format('d/m/Y g:i A');
                                                @endphp
                                                @if ($today->greaterThanOrEqualTo($c->expiration) && $c->verificacion != '2')
                                                    <br>
                                                    <span class="badge badge-warning">
                                                        Vencido
                                                    </span>
                                                @endif
                                            @else
                                                Fecha no generada
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (Auth::check())
                                                <div class="">
                                                    @can('checklist.show')
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('checklist.show', ['checklist' => $c->id]) }}"
                                                            title="Ver"><i class="fa-regular fa-eye text-8"></i></a>
                                                    @endcan

                                                    @if ($c->status != '2' && $c->verificacion == '0')
                                                        @can('checklist.first-edit')
                                                            <a class="btn btn-sm btn-secondary"
                                                                href="{{ route('checklist.first-edit', ['checklist' => $c->id]) }}"
                                                                title="Asignar empleado"><i
                                                                    class="fa-solid fa-1 text-8"></i><i
                                                                    class="fa-solid fa-a text-8"></i></a>
                                                        @endcan
                                                    @endif

                                                    @if ($c->status != '2' && $c->verificacion != '2')
                                                        @can('checklist.second-edit')
                                                            <a class="btn btn-sm btn-danger"
                                                                href="{{ route('checklist.second-edit', ['checklist' => $c->id]) }}"
                                                                title="Asignar supervisor"><i
                                                                    class="fa-solid fa-2 text-8"></i><i
                                                                    class="fa-solid fa-a text-8"></i></a>
                                                        @endcan
                                                    @endif

                                                    @if ($c->status == '1' && $c->verificacion == '0')
                                                        @can('checklist.interchange')
                                                            <a class="btn btn-sm btn-warning"
                                                                href="{{ route('checklist.interchange', ['checklist' => $c->id]) }}"
                                                                title="Intercambiar usuarios asignados"><i
                                                                    class="fa-solid fa-i text-8"></i></a>
                                                        @endcan
                                                    @endif

                                                    @if ($c->status == '1' && $c->employee_id != 1)
                                                        @if ($c->verificacion == '0' && $c->employee_id == auth()->user()->id)
                                                            @can('checklist.first-verify-edit')
                                                                <a class="btn btn-sm btn-secondary"
                                                                    href="{{ route('checklist.first-verify-edit', ['checklist' => $c->id]) }}"
                                                                    title="1ra Verificación"><i
                                                                        class="fa-solid fa-1 text-8"></i><i
                                                                        class="fa-solid fa-v text-8"></i></a>
                                                            @endcan
                                                        @endif
                                                    @endif

                                                    @if ($c->status == '1' && $c->supervisor_id != 1)
                                                        @if ($c->verificacion == '1' && $c->supervisor_id == auth()->user()->id)
                                                            @can('checklist.second-verify-edit')
                                                                <a class="btn btn-sm btn-danger"
                                                                    href="{{ route('checklist.second-verify-edit', ['checklist' => $c->id]) }}"
                                                                    title="2da Verificación"><i
                                                                        class="fa-solid fa-2 text-8"></i><i
                                                                        class="fa-solid fa-v text-8"></i></a>
                                                            @endcan
                                                        @endif
                                                    @endif

                                                    {{-- <button class="btn btn-sm btn-dark confirmation" onclick="" title="Eliminar"><i class="fa-regular fa-trash-can"></i></button> --}}
                                                </div>
                                                {{-- </form> --}}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4>No se encontraron checklists</h4>
            @endif

            @if ($checklists->hasPages())
                <div class="container">
                    <div class="row">
                        <div class="col-8 col-offset-2">
                            {!! $checklists->links() !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>





</div>
