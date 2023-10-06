@extends('admin.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.structure.min.css') }}">
@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-6 offset-3">
                <br>
                <h4 class="">Logs</h4>
                <br>
            </div>
        </div>

        <form action="{{ route('log.generate-show') }}" method="POST">

            {{ csrf_field() }}

            <div class="row">
                <div class="col-3 offset-3">
                    <div class="form-group">
                        <label for="date_from" class="text-9 font-weight-bold">Desde:</label>
                        <input type="text" name="date_from" id="datepicker" class="form-control text-9" />
                    </div>
                </div>
                <div class="column is-3">
                    <div class="form-group">
                        <label for="date_to" class="text-9 font-weight-bold">Hasta:</label>
                        <input type="text" name="date_to" id="datepicker1" class="form-control text-9" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 offset-3">
                    <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
                </div>
            </div>
             <br>

        </form>
    </div>

@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
                //minDate: -5,
                maxDate: "+0D",
                dateFormat: 'dd-mm-yy',
                dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ],
                beforeShow: function (input, inst) {
                var rect = input.getBoundingClientRect();
                setTimeout(function () {
                    inst.dpDiv.css({ top: rect.top + 40, left: rect.left + 0 });
                }, 0);
            }
            });
    } );
    </script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker1" ).datepicker({
            //minDate: +0,
            maxDate: "+0D",
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ],
            beforeShow: function (input, inst) {
                var rect = input.getBoundingClientRect();
                setTimeout(function () {
                    inst.dpDiv.css({ top: rect.top + 40, left: rect.left + 0 });
                }, 0);
            }
         });
    } );
    </script>
@endsection
