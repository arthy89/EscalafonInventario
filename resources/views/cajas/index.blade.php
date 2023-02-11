@extends('adminlte::page')

@section('title', 'Cajas')
<style>
    .mayus{
        text-transform: uppercase;
    }
</style>
@section('content_header')
    &nbsp;&nbsp;<a href="{{route('nueva_caja')}}" class="btn btn-success"><i class="fas fa-plus"></i> &nbsp; AGREGAR NUEVA CAJA</a>
@stop

@section('content')
    <div class="container-fluid">
        <div class="content">
            <h1 class="text-center">ACTIVOS</h1>
            <div class="row mayus">
                @foreach ($cajas as $caja)
                <div class="col-md-4">
                    <form action="{{route('eliminar_caja',$caja->id_caja)}}" method="POST">

                        @csrf

                        @method('delete')
                        
                        <div class="card shadow card-info">
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
                                <hr>
                                <small>
                                    <ol>
                                        @foreach ($docentes as $docente)
                                            
                                            @if ($caja->id_caja !== $docente->id_caja)
                                                @continue
                                            @else
                                                    <li>{{$docente->dcnt_apell1}} {{$docente->dcnt_apell2}}, {{$docente->dcnt_name}}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </small>
                                
                                <hr>
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
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> ELIMINAR</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>

            {{-- cesantes pension nolegix --}}
            <hr>
            <h1 class="text-center">CESANTES / PENSIONISTAS / NO LEGIX</h1>
            <div class="row mayus">
                @foreach ($caja_c as $cajac)
                    <div class="col-md-4">
                    <form action="{{route('eliminar_caja',$cajac->id_caja)}}" method="POST">

                        @csrf

                        @method('delete')
                        
                        @if ($cajac->est_name == "CESANTE")
                            <div class="card shadow card-warning">
                        @elseif($cajac->est_name == "PENSIONISTA")
                            <div class="card shadow card-orange">
                        @elseif($cajac->est_name == "NO LEGIX")
                            <div class="card shadow card-purple">
                        @endif
                        
                            <div class="card-header">
                                <div class="card-title"><strong>CAJA N° {{ $cajac->caja_num_let }} - {{ $cajac->est_name }}</strong></div>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <strong>{{ $cajac->caja_tipo_per }}</strong>
                                <hr>
                                <small>
                                    <ol>
                                        @foreach ($docentes as $docente)
                                            
                                            @if ($cajac->id_caja !== $docente->id_caja)
                                                @continue
                                            @else
                                                    <li>{{$docente->dcnt_apell1}} {{$docente->dcnt_apell2}}, {{$docente->dcnt_name}}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </small>
                                <hr>
                            </div>
                            <div class="card-footer">
                                @if (@empty($cajac->caja_obs))
                                    <p style="text-transform: uppercase;"><b><i class="fas fa-eye"></i> Observaciones:</b> Sin Observaciones</p>
                                @else
                                    <p style="text-transform: uppercase;"><b><i class="fas fa-eye"></i> Observaciones:</b> {{ $cajac->caja_obs }}</p>
                                @endif
                                <hr>
                                <div class="text-right">
                                    <a href=" {{ route('editar_caja', $cajac->id_caja) }} " class="btn btn-warning btn-sm"><i class="fas fa-pen"></i> EDITAR</a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> ELIMINAR</button>
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
@stop

@section('js')
    <script>

        // let estado = "{{ $caja->est_name }}";
        // let card = document.getElementById('card');

        // switch(estado){
        //     case "ACTIVO": 
        //     card.classList.add("card-info");
        //     break;
        //     case "CESANTE": 
        //     card.classList.add("card-warning");
        //     break;
        //     case "PENSIONISTA": 
        //     card.classList.add("card-orange");
        //     break;
        //     case "NO LEGIX": 
        //     card.classList.add("card-purple");
        //     break;
        // }
    </script>
@stop