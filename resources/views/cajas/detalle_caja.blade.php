@extends('adminlte::page')

@section('title', 'Detalle de caja')
<style>
    .mayus {
        text-transform: uppercase;
    }
</style>
@section('content_header')
    <div class="row mayus">
        @if ($caja->id_est == 1)
            <div class="col-md-6"><h1>CAJA N° {{$caja_act[0]->caja_num_let}} - {{$caja_act[0]->est_name}}</h1></div>
        @else
            <div class="col-md-6"><h1>CAJA N° {{$caja->caja_num_let}} - {{$caja->est_name}}</h1></div>
        @endif
        <div class="col-md-6 text-right">
            <div class="btn-group">
                <a href="{{route('nueva_caja')}}" class="btn btn-outline-success"><i class="fa fa-plus "></i> <i class="fa fa-user-tie "></i> AGREGAR NUEVA CAJA</a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if ($caja->id_est == 1)
                    <div class="card card-info card-outline">
                @elseif($caja->id_est == 2)
                    <div class="card card-warning card-outline">
                @elseif($caja->id_est == 3)
                    <div class="card card-orange card-outline">
                @else
                    <div class="card card-purple card-outline">
                @endif
                    @if ($caja->id_est == 1)
                        <div class="card-header mayus">
                            <strong>
                                {{$caja_act[0]->tipo_inst}} {{$caja_act[0]->inst_name}} - {{$caja_act[0]->inst_lugar}}
                            </strong>
                            <p>
                                <small>
                                    <strong>OBSERVACIONES:</strong> {{$caja_act[0]->caja_obs}}
                                </small>
                            </p>
                        </div>
                    @else
                    <div class="card-header mayus">
                        <small>
                            <strong>OBSERVACIONES:</strong> {{$caja->caja_obs}}
                        </small>
                    </div>  
                    @endif
                    <div class="card-body">
                        <table id="registro" class="table table-striped shadow p-3 mb-5 bg-body rounded mt-4" style="text-transform: uppercase;">
                            @if ($caja->id_est == 1)
                                <thead class="bg-lightblue text-white">
                            @elseif($caja->id_est == 2)
                                <thead class="bg-warning">
                            @elseif($caja->id_est == 3)
                                <thead class="bg-orange">
                            @else
                                <thead class="bg-purple text-white">
                            @endif
                                <tr>
                                    <th>N°</th>
                                    <th>DNI</th>
                                    <th>APELLIDO Y NOMBRES</th>
                                    <th>INSTITUCION</th>
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
                                        {{-- institucion --}}
                                        <td>{{ $docente->tipo_inst }} {{ $docente->inst_name }} - {{ $docente->inst_lugar }}</td>
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
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('resources/bootstrap5/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('resources/datatable/dataTables.bootstrap5.min.css')}}">
@stop

@section('js')
    <script src="{{ asset('resources/jquery351/jquery-3.5.1.js')}}"></script>
    <script src="{{ asset('resources/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('resources/datatable/dataTables.bootstrap5.min.js')}}"></script>

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
            'Se eliminó la caja correctamente',
            'success'
            )
        </script>
    @endif

    <script>

        $('.formulario').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estás seguro de eliminar la caja?',
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