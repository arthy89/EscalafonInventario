@extends('adminlte::page')

@section('title', 'Cajas')
<style>
    .mayus{
        text-transform: uppercase;
    }
</style>
@section('content_header')
    <div class="row">
        <div class="col-md-6"><h1>REGISTRO DE CAJAS</h1></div>
        <div class="col-md-6 text-right">
            <div class="btn-group">
                <a href="{{route('registros')}}" class="btn btn-outline-danger"><i class="fa fa-arrow-circle-left "></i> ATRAS</a>
                <a href="{{route('nuevo')}}" class="btn btn-outline-success"><i class="fa fa-plus "></i> <i class="fa fa-user-tie "></i> AGREGAR NUEVA CAJA</a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="content">
            <h1 class="text-center">TODAS LAS CAJAS REGISTRADAS</h1>
            <div class="row mayus">
                <div class="col-md-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$total_t}}</h3>
                            <p><h4><strong>Todas las cajas</strong></h4></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <a href="{{route('caja_t_list')}}" class="small-box-footer">
                        VER REGISTRO <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <h1 class="text-center">CAJAS EN PARTES</h1>
            <div class="row mayus">
                {{-- ACTIVOS --}}
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$total_activos}}</h3>
                            <p><h4><strong>ACTIVOS</strong></h4></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="{{route('activos_list_ops')}}" class="small-box-footer">
                        VER REGISTRO <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                {{-- CESANTES --}}
                <div class="col-md-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$total_cesantes}}</h3>
                            <p><h4><strong>CESANTES</strong></h4></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <a href="{{route('cesantes_list_ops')}}" class="small-box-footer">
                        VER REGISTRO <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                {{-- PENSIONISTA --}}
                <div class="col-md-3">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3>{{$total_pensionistas}}</h3>
                            <p><h4><strong>PENSIONISTAS</strong></h4></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <a href="{{route('pensionistas_list_ops')}}" class="small-box-footer">
                        VER REGISTRO <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                {{-- NO LEGIX --}}
                <div class="col-md-3">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>{{$total_nolegix}}</h3>
                            <p><h4><strong>NO LEGIX</strong></h4></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-minus-circle"></i>
                        </div>
                        <a href="{{route('nolegix_list_ops')}}" class="small-box-footer">
                        VER REGISTRO <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('resources/bootstrap5/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('resources/datatable/dataTables.bootstrap5.min.css')}}"> --}}
@stop

@section('js')
    {{-- <script src="{{ asset('resources/jquery351/jquery-3.5.1.js')}}"></script>
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

        
    </script> --}}
@stop