@php
    use RealRashid\SweetAlert\Facades\Alert;
@endphp

@if (session()->has('message'))
    {{-- <div class="container">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="alert alert-primary">
                    <button class="alert-dismissible close" data-dismiss="alert"><i class="fa-solid fa-xmark text-primary"></i></button>
                    {{ session()->get('message') }}
                </div>
            </div>
        </div>
    </div> --}}
    @php
        $message = session()->get('message');
        Alert::info('Exito', $message);
    @endphp
@elseif (session()->has('error'))
    {{-- <div class="container">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="alert alert-success">
                    <button class="alert-dismissible close" data-dismiss="alert"><i class="fa-solid fa-xmark text-success"></i></button>
                    {{ session()->get('error') }}
                </div>
            </div>
        </div>
    </div> --}}
    @php
        $error = session()->get('error');
        Alert::error('Error', $error);
    @endphp
@elseif (session()->has('warning'))
    {{-- <div class="container">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="alert alert-warning">
                    <button class=".alert-dismissible close" data-dismiss="alert"><i class="fa-solid fa-xmark text-warning"></i></button>
                    {{ session()->get('warning') }}
                </div>
            </div>
        </div>
    </div> --}}
    @php
        $warning = session()->get('warning');
        Alert::warning('Cuidado', $warning);
    @endphp
@endif
