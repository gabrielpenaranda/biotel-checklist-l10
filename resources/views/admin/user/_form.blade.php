<div class="container">
    <div class="row mt-3">
        <div class="col-6 offset-2">
            @if ($user->exists)
                <h4 class="">Editar Usuario</h4>
                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <h4 class="">Crear Usuario</h4>
                <form action="{{ route('user.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="col-2">
            <a class="btn btn-danger btn-sm" href="{{ route('user.index') }}">Regresar</a>
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-8 offset-2">
            <div class="form-group">
                <label for="name" class="text-9 font-weight-bold">Nombre</label>
                <input type="text" name="name" class="form-control text-9" value="{{ $user->exists ? $user->name : old('name') }}" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            @if ($user->exists)
                <div class="form-group">
                    <span class="text-9 font-weight-bold">Email</span>
                    <span class="text-9 form-control text-success font-weight-bold">{{ $user->email }}</span>
                </div>
            @else
                <div class="form-group">
                    <label for="email" class="text-9 font-weight-bold">Email</label>
                    <input type="text" name="email" class="form-control text-9" value="{{ $user->exists ? $user->email : old('email') }}"/>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
             @if ($user->exists)
                <div class="form-group">
                    <span class="text-9 font-weight-bold">Cédula de identidad</span>
                    <span class="text-9 form-control text-success font-weight-bold">{{ $user->identification }}</span>
                </div>
            @else
                <div class="form-group">
                    <label for="identification" class="text-9 font-weight-bold">Cédula de identidad</label>
                    <input type="text" name="identification" class="form-control text-9" value="{{ $user->exists ? $user->identification : old('identification') }}"/>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group">
                <label for="position" class="text-9 font-weight-bold">Cargo</label>
                <input type="text" name="position" class="form-control text-9" value="{{ $user->exists ? $user->position : old('position') }}"/>
            </div>
        </div>
    </div>

    @if (!$user->exists)
        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group">
                    <label for="password" class="text-9 font-weight-bold">Contraseña</label>
                    <input type="password" name="password" class="form-control text-9" value="{{ $user->exists ? $user->password : old('password') }}"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group">
                    <label for="password-confirmation" class="text-9 font-weight-bold">Confirmar contraseña</label>
                    <input type="password" name="password-confirmation" class="form-control text-9" value="{{ $user->exists ? $user->password-confirmation : old('password-confirmation') }}"/>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-8 offset-2">
            @if($user->exists)
                @can('user.edit')
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                @endcan
            @else
                @can('user.create')
                <button type="submit" class="btn btn-primary btn-sm">Grabar</button>
                @endcan
            @endif
        </div>
    </div>
    <br>
    </form>
</div>
</div>
