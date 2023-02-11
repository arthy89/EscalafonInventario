<!doctype html>
<html lang="es">

<head>
    <title>LISTA NO LEGIX</title>
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
        {{-- CABEZADO --}}
        <table>
            <tr>
                <td width="330px"><img src="{{ asset('resources/img/logo-minedu.png') }}" width="80%"></td>
                <td class="text-center">
                    <h5>DIRECCIÓN REGIONAL DE EDUCACIÓN PUNO</h5>
                    <h6>OFICINA DE ESCALAFÓN</h6>
                </td>
                <td class="text-right"><img src="{{ asset('resources/img/logo-puno.png') }}" width="40%"></td>
            </tr>
        </table>
        
        <h5 class=" font-weight-bold text-center">LISTA DE PERSONAL NO REGISTRADO EN LEGIX</h5>
        <br>

        @foreach ($cajas as $caja)
        @php
            $i = 0;
        @endphp
        <h6 class="font-weight-bold text-left">CAJA N° {{ $caja->caja_num_let }}</h6>

        {{-- TABLA DE DOCENTES --}}
        <table class="table table-bordered table-sm">
            <thead style="background-color: #D9D9D9; font-size: 12px;" class="text-center">
                <tr>
                    <th>N°</th>
                    <th>IS. DONDE CESO</th>
                    <th>APELL. PATERNO</th>
                    <th>APELL. MATERNO</th>
                    <th>NOMBRES</th>
                    <th>FEC. CESE</th>
                    <th>RDR</th>
                    <th>TIP. CESE</th>
                    <th>OBSERVACIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $docente)
                    
                    @if ($caja->id_caja !== $docente->id_caja)
                        @continue
                    @else
                    
                        <tr>
                            <td class="text-center">{{ $i = $i + 1 }}</td>
                            {{-- institucion --}}
                            <td>{{ $docente->tipo_inst }} {{ $docente->inst_name }} - {{ $docente->inst_lugar }}</td>
                            {{-- apellidos paterno --}}
                            <td>{{ $docente->dcnt_apell1 }}</td>
                            {{-- apellido materno --}}
                            <td>{{ $docente->dcnt_apell2 }}</td>
                            {{-- nombres --}}
                            <td>{{ $docente->dcnt_name }}</td>
                            {{-- fecha de cese --}}
                            <td>{{ $docente->dcnt_fec_ces }}</td>
                            {{-- rdr --}}
                            <td>{{ $docente->dcnt_rdr }}</td>
                            {{-- tipo de cese --}}
                            <td>{{ $docente->dcnt_tip_ces }}</td>
                            {{-- observaciones --}}
                            <td>
                                @if(empty($docente->dcnt_obs))
                                    
                                @else
                                    {{ $docente->dcnt_obs }}
                                @endif
                            </td>
                        </tr>
                    @endif
                    
                @endforeach
            </tbody>
        </table>

        
        @endforeach
    </div>
</body>
</html>
