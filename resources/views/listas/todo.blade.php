@extends('adminlte::page')

@section('title', 'Registro General')

@section('content_header')
    <div class="row">
        <div class="col-md-6"><h1>REGISTRO GENERAL</h1></div>
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
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        TODOS LOS REGISTROS EXISTENTES
                    </div>
                    <div class="card-body">
                        <table id="registro" class="table table-striped shadow p-3 mb-5 bg-body rounded mt-4" style="text-transform: uppercase;">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>N°</th>
                                    <th>DNI</th>
                                    <th>APELLIDO Y NOMBRES</th>
                                    <th>CARGO</th>
                                    <th>SITUACION</th>
                                    <th>INSTITUCION</th>
                                    <th>CAJA N°</th>
                                    <th>OBSERVACIONES</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="{{route('generar_pdf_todo')}}" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> GENERAR PDF</a>
                        </div>
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
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ asset('resources/sweetalert/sweetalert2@11.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#registro').DataTable(
                {
                processing: true,
                serverSide: true,
                ajax: "{{route('todo_list')}}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex', orderable: true, searchable: true
                    },
                    {
                        data: 'dcnt_dni',
                        name: 'dcnt_dni'
                    },
                    {
                        data: 'nombres',
                    },
                    {
                        data: 'car_name',
                        name: 'car_name'
                    },
                    {
                        data: 'est_name',
                        name: 'est_name'
                    },
                    {
                        data: 'institucion',
                    },
                    {
                        data: 'caja_num_let',
                        name: 'caja_num_let'
                    },
                    {
                        data: 'dcnt_obs',
                        name: 'dcnt_obs'
                    },
                    {
                        data: 'action', sWidth: '110px', sortable: false
                    },
                ],
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
        // $('.formulario').submit(function(e){
        $(document).on('submit','.formulario', function(e){
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