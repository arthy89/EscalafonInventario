@extends('adminlte::page')

@section('title', 'Cajas')

@section('content_header')
    &nbsp;&nbsp;<a href="{{route('nueva_caja')}}" class="btn btn-success"><i class="fas fa-plus"></i> &nbsp; AGREGAR NUEVA CAJA</a>
@stop

@section('content')
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                @foreach ($cajas as $caja)
                <div class="col-md-4">
                    <form action="{{route('eliminar_caja',$caja->id_caja)}}" method="POST">

                        @csrf

                        @method('delete')

                        <div class="card card-primary shadow">
                            <div class="card-header">
                                <div class="card-title"><strong>CAJA N° {{ $caja->caja_num_let }} - {{ $caja->inst_lugar }}</strong></div>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <strong>{{ $caja->est_name }} - {{ $caja->tipo_inst }} {{ $caja->inst_name }}</strong>
                                <br>
                                <strong>{{ $caja->caja_tipo_per }}</strong>
                            </div>
                            <div class="card-footer">
                                @if (@empty($caja->caja_obs))
                                    <p style="text-transform: uppercase;"><b><i class="fas fa-eye"></i> Observaciones:</b> Sin Observaciones</p>
                                @else
                                    <p style="text-transform: uppercase;"><b><i class="fas fa-eye"></i> Observaciones:</b> {{ $caja->caja_obs }}</p>
                                @endif
                                <hr>
                                <div class="text-right">
                                    <a href=" {{ route('editar_caja', $caja->id_caja) }} " class="btn btn-warning btn-sm"><i class="fas fa-pen"></i> EDITAR</a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> EDITAR</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop