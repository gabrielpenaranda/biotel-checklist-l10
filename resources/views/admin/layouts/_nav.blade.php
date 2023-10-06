<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-green">
    <a class="navbar-brand" href="{{ route('dashboard') }}"><img src="{{ asset('img/biotel-1000.png') }}" alt="Biotel"
            class="" width="130px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                @if (auth()->user()->can('user.index') ||
                    auth()->user()->can('user.show-deleted-user') ||
                    auth()->user()->can('log.show'))
                    <a class="nav-link dropdown-toggle text-9 bg-green" href="#" id="navbarAdmin" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Configuración
                    </a>
                @endif
                <div class="dropdown-menu bg-green" aria-labelledby="navbarDropdown">
                    @can('user.index')
                        <a class="dropdown-item text-9" href="{{ route('user.index') }}">Usuarios</a>
                    @endcan
                    @can('user.show-deleted-user')
                        <a class="dropdown-item text-9" href="{{ route('user.show-deleted-user') }}">Usuarios
                            Eliminados</a>
                    @endcan
                    <div class="dropdown-divider"></div>
                    @can('log.show')
                        <a class="dropdown-item text-9" href="{{ route('log.show') }}">Log</a>
                    @endcan
                </div>
            </li>
            <li class="nav-item dropdown">
                @if (auth()->user()->can('checklist-model.index') ||
                    auth()->user()->can('checklist.index') ||
                    auth()->user()->can('checklist.checklist-by-users') ||
                    auth()->user()->can('checklist.expired'))
                    <a class="nav-link dropdown-toggle text-9 bg-green" href="#" id="navbarAdmin" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Checklists
                    </a>
                @endif
                <div class="dropdown-menu bg-green" aria-labelledby="navbarDropdown">
                    @can('checklist-model.index')
                        <a class="dropdown-item text-9" href="{{ route('checklist-model.index') }}">Modelos de
                            Checklist</a>
                    @endcan
                    @can('checklist.index')
                        <a class="dropdown-item text-9" href="{{ route('checklist.index') }}">Checklists Generados</a>
                    @endcan
                    @can('checklist.checklist-by-user')
                        <a class="dropdown-item text-9" href="{{ route('checklist.checklist-by-users') }}">Checklists
                            Usuarios</a>
                    @endcan
                    {{-- @can('checklist.expired')
                        <a class="dropdown-item text-9" href="{{ route('checklist.expired') }}">Checklists Vencidos</a>
                    @endcan --}}
                </div>
            </li>
        </ul>
        {{-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
             <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">{{ __('Log Out') }}</button>

                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Salir</button>
                </form>


        </form> --}}
        <div>
            <em class="text-6 font-weight-bold font-italic">{{ auth()->user()->name }}</em>
            <a class="btn btn-dark btn-sm my-2 my-sm-0" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <strong>Salir</strong>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"
                class="form-inline my-2 my-lg-0">
                @csrf

            </form>
        </div>
    </div>
</nav>
