<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .text-7 {
            font-size: 0.7rem;
        }

        .text-8 {
            font-size: 0.8rem;
        }

        .text-9 {
            font-size: 0.9rem;
        }

        .text-center {
            text-align: center;
        }
        .header {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body>
        <h4 class="">Checklist Nº {{ $data['checklist_id'] }} </h4>

                <table>
                    <thead class="header">
                        <th class="text-center text-9">Nombre</th>
                        <th class="text-center text-9">Descripcion</th>
                        <th class="text-center text-9">Status</th>
                        <th class="text-center text-9">Fecha de creación</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="text-center text-9">
                            {{ $data['checklist_name'] }}
                        </td>
                        <td class="text-center text-9">
                            {{ $data['checklist_description'] }}
                        </td>
                        <td class="text-center text-9">
                            {{ $data['checklist_status'] }}
                        </td>
                        <td class="text-center text-9">
                            {{ $data['checklist_created_at'] }}
                        </td>
                    </tbody>
                </table>

                <table>
                    <thead class="header">
                        <th class="text-center text-9">Empleado asignado</th>
                        <th class="text-center text-9">Supervisor asignado</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="text-center text-9" style="width: 50%">
                            {{ $data['checklist_employee'] }}
                        </td>
                        <td class="text-center text-9" style="width: 50%">
                            {{ $data['checklist_supervisor'] }}
                        </td>
                    </tbody>
                </table>

                <table>
                    <thead class="header">
                        <th>Fecha 1<sup>ra</sup> Verificación</th>
                        <th>Fecha 2<sup>da</sup> Verificación</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ $data['checklist_first_date'] }}
                            </td>
                            <td>
                                {{ $data['checklist_second_date'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table>
                    <thead class="header">
                        <th class="text-center text-8" style="width: 5%">#</th>
                        <th class="text-center text-8" style="width: 25%">Descripción</th>
                        <th class="text-center text-8" style="width: 10%">
                            Primera
                        </th>
                        <th class="text-center text-8" style="width: 25%">Observaciones</th>
                        <th class="text-center text-8" style="width: 10%">
                            Segunda
                        </th>
                        <th class="text-center text-8" style="width: 25%">Observaciones</th>
                    </thead>
                    <tbody>
                        @foreach ($elements as $c)
                        <tr>
                            <td class="text-center text-8" style="width: 5%">
                                {{ $c->element_number }}
                            </td>
                            <td class="text-8" style="width: 25%">
                                @if ($c->level == 1)
                                    &nbsp; &nbsp; {{ $c->description }}
                                @else
                                    {{ $c->description }}
                                @endif
                            </td>
                            <td class="text-center text-8" style="width: 10%">
                                @if ($c->column_one)
                                    x
                                @endif
                            </td>
                            <td class="text-7" style="width: 25%">
                                {{ $c->column_two }}
                            </td>
                            <td class="text-center text-8" style="width: 10%">
                               @if ($c->column_three)
                                    x
                               @endif
                            </td>
                            <td class="text-7" style="width: 25%;">
                                {{ $c->column_four }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>
</html>


