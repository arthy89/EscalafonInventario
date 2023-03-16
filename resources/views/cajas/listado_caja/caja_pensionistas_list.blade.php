@extends('adminlte::page')

@section('title', 'Listado de Cajas')

@section('content_header')
    <div class="row">
        <div class="col-md-6"><h1>LISTADO DE CAJAS PENSIONISTAS</h1></div>
        <div class="col-md-6 text-right">
            <div class="btn-group">
                <a href="{{route('cajas')}}" class="btn btn-outline-danger"><i class="fa fa-arrow-circle-left "></i> ATRAS</a>
                <a href="{{route('nueva_caja')}}" class="btn btn-outline-success"><i class="fa fa-plus "></i> <i class="fa fa-user-tie "></i> AGREGAR NUEVA CAJA</a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-orange card-outline">
                    <div class="card-header">
                        REGISTROS DE CAJAS PENSIONISTAS
                    </div>
                    <div class="card-body">
                        <table id="registro" class="table table-striped shadow p-3 mb-5 bg-body rounded mt-4" style="text-transform: uppercase;">
                            <thead class="bg-orange">
                                <tr>
                                    <th>N°</th>
                                    <th>CAJA N°</th>
                                    <th>TIPO PER</th>
                                    <th>ESTADO</th>
                                    <th>OBSERVACIONES</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cajas as $caja)
                                    <tr>
                                        {{-- Num --}}
                                        <td> {{ $loop->iteration }}</td>
                                        {{-- caja num --}}
                                        <td>{{ $caja->caja_num_let }}</td>
                                        {{-- tipo per --}}
                                        <td>{{ $caja->caja_tipo_per }}</td>
                                        {{-- estado --}}
                                        <td>{{ $caja->est_name }}</td>
                                        {{-- observaciones --}}
                                        <td>
                                            @if(empty($caja->caja_obs))
                                                -
                                            @else
                                                {{ $caja->caja_obs }}
                                            @endif
                                        </td>
                                        <td width="110px">
                                            <form action="{{route('eliminar_caja', $caja->id_caja)}}" method="POST" class="formulario">
                                                @csrf
                                                @method('delete')
                                                <a href="{{route('editar_caja', $caja->id_caja)}}" class="btn btn-warning btn-sm"> <i class="fas fa-pen"></i> </a>&nbsp<a href="{{route('detalles_caja', $caja->id_caja)}}" class="btn btn-primary btn-sm"><i class="fas fa-table"></i> </a>
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