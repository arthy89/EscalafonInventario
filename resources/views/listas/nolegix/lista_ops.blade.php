@extends('adminlte::page')

@section('title', 'Lista Activos')

@section('content_header')
    <div class="row">
        <div class="col-md-6"><h1>NO REGISTRADOS EN LEGIX</h1></div>
        <div class="col-md-6 text-right">
            <div class="btn-group">
                <a href="{{route('registros')}}" class="btn btn-outline-danger"><i class="fa fa-arrow-circle-left "></i> ATRAS</a>
                <a href="{{route('nuevo')}}" class="btn btn-outline-success"><i class="fa fa-plus "></i> <i class="fa fa-user-tie "></i> AGREGAR NUEVO PERSONAL</a>
                
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        REGISTROS PERSONAL NO REGISTRADO EN LEGIX
                    </div>
                    <div class="card-body">
                        <table id="registro" class="table table-striped shadow p-3 mb-5 bg-body rounded mt-4" style="text-transform: uppercase;">
                            <thead class="bg-purple">
                                <tr>
                                    <th>N°</th>
                                    <th>DNI</th>
                                    <th>APELLIDOS Y NOMBRES</th>
                                    <th>CAJA N° </th>
                                    <th>IS. DONDE CESO</th>
                                    <th>FEC. CESE</th>
                                    <th>RDR</th>
                                    <th>TIP. CESE</th>
                                    <th>OBSERVACIONES</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docentes as $docente)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        {{-- dni --}}
                                        <td>{{ $docente->dcnt_dni }}</td>
                                        {{-- apellidos y nombres --}}
                                        <td>{{ $docente->dcnt_apell1 }} {{ $docente->dcnt_apell2 }} {{ $docente->dcnt_name }}</td>
                                        {{-- caja --}}
                                        <td>{{ $docente->caja_num_let}}</td>
                                        {{-- institucion --}}
                                        <td>{{ $docente->tipo_inst }} {{ $docente->inst_name }} - {{ $docente->inst_lugar }}</td>
                                        {{-- fecha de cese --}}
                                        <td>{{ $docente->dcnt_fec_ces }}</td>
                                        {{-- rdr --}}
                                        <td>{{ $docente->dcnt_rdr }}</td>
                                        {{-- tipo de cese --}}
                                        <td>{{ $docente->dcnt_tip_ces }}</td>
                                        {{-- observaciones --}}
                                        <td>
                                            @if(empty($docente->dcnt_obs))
                                                -
                                            @else
                                                {{ $docente->dcnt_obs }}
                                            @endif
                                        </td>
                                        <td width="110px">
                                            <form action="{{route('doconte_eliminar', $docente->id_dcnt)}}" method="POST" class="formulario">
                                                @csrf
                                                @method('delete')
                                                <a href="{{route('editar', $docente->id_dcnt)}}" class="btn btn-warning btn-sm"> <i class="fas fa-pen"></i> </a>&nbsp<a href="{{route('docente_detalles', $docente->id_dcnt)}}" class="btn btn-primary btn-sm"><i class="fas fa-table"></i> </a>
                                                <button type="submit" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="{{route('generar_pdf_nolegix')}}" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> GENERAR PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="../../resources/bootstrap5/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/datatable/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="../../resources/jquery351/jquery-3.5.1.js"></script>
    <script src="../../resources/datatable/jquery.dataTables.min.js"></script>
    <script src="../../resources/datatable/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#registro').DataTable(
                {
                    "language":{
                        "search":       "Buscar",
                        "lengthMenu":   "Mostrar _MENU_ registros por página",
                        "info":         "Mostrando página _PAGE_ de _PAGES_",
                        "paginate":     {
                                        "previous":  "Anterior",
                                        "next":     "Siguiente",
                                        "first":    "Primero",
                                        "last":     "Último"
                        }

                    }
                }
            );
        });
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'Se eliminó al personal correctamente',
            'success'
            )
        </script>
    @endif

    <script>

        $('.formulario').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estás seguro de eliminar al personal?',
            text: "Se eliminará al personal",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminar!',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
            })
        });

        
    </script>
@stop