<!doctype html>
<html lang="es">

<head>
    <title>LISTA GENERAL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="resources/bootstrap5/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('resources/bootstrap5/bootstrap.min.css') }}"> --}}
    <style>
        table {
            font-size: 10px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="row">
        {{-- <div class="row">
            <div class="col">
                <img src="{{ asset('resources/img/logo-minedu.png') }}" width="30%">
            </div>
            <div class="col">
                <h3>HOLA MUNDO</h3>
            </div>
            <div class="col">
                <p>xd</p>
            </div>
        </div> --}}
        <table>
            <tr>
                <td width="180px"><img src="{{ asset('resources/img/logo-minedu.png') }}" width="80%"></td>
                <td class="text-center">
                    <h5>DIRECCIÓN REGIONAL DE EDUCACIÓN PUNO</h5>
                    <h6>OFICINA DE ESCALAFÓN</h6>
                </td>
                <td class="text-right"><img src="{{ asset('resources/img/logo-puno.png') }}" width="40%"></td>
            </tr>
        </table>
        <h5 class=" font-weight-bold text-center">LISTA DE PERSONAL ACTIVO</h5>
        <table class="table table-bordered table-sm">
            <thead style="background-color: #D9D9D9; font-size: 12px;" class="text-center">
                <tr>
                    <th>N°</th>
                    <th>APELL. PATERNO</th>
                    <th>APELL. MATERNO</th>
                    <th>NOMBRES</th>
                    <th>OBSERVACIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $docente)
                    <tr>
                        <td> {{ $loop->iteration }}</td>
                        {{-- apellido paterno--}}
                        <td>{{ $docente->dcnt_apell1 }}</td>
                        {{-- apellido materno --}}
                        <td>{{ $docente->dcnt_apell2 }}</td>
                        {{-- nombres --}}
                        <td> {{ $docente->dcnt_name }}</td>
                        {{-- observaciones --}}
                        <td>
                            @if(empty($docente->dcnt_obs))
                                
                            @else
                                {{ $docente->dcnt_obs }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
