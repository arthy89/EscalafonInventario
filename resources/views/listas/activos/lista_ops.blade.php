@extends('adminlte::page')

@section('title', 'Lista Activos')

@section('content_header')
    <h1>ACTIVOS</h1>
@stop

@section('content')
    <p>LISTA ACTIVOS</p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        REGISTROS PERSONAL ACTIVO
                    </div>
                    <div class="card-body">
                        <table id="registro" class="table table-striped shadow p-3 mb-5 bg-body rounded mt-4">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>N°</th>
                                    <th>APELLIDO PATERNO</th>
                                    <th>APELLIDO MATERNO</th>
                                    <th>NOMBRES</th>
                                    <th>OBSERVACIONES</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docentes as $docente)
                                    <tr>
                                        <td>{{ $docente->id_dcnt }}</td>
                                        {{-- apell paterno --}}
                                        <td>{{ $docente->dcnt_apell1 }}</td>
                                        {{-- materno --}}
                                        <td>{{ $docente->dcnt_apell2 }}</td>
                                        {{-- nombres --}}
                                        <td>{{ $docente->dcnt_name }}</td>
                                        {{--  --}}
                                        <td>
                                            @if(empty($docente->dcnt_obs))
                                                -
                                            @else
                                                {{ $docente->dcnt_obs }}
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{--route('eliminar_registro', $registro)--}}" method="POST">
                                                {{-- @csrf
                                                @method('delete') --}}
                                                <a href="{{-- route('editar_registro', $registro->id_rr) --}}" class="btn btn-warning btn-sm">Editar</a>&nbsp<a href="{{--route('accion', $registro->id_rr) --}}" class="btn btn-danger btn-sm">Acción</a>
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        xd
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
@stop