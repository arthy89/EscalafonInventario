@extends('adminlte::page')

@section('title', 'Detalles')
<style>
    .mayus{
        text-transform: uppercase;
    }
</style>
@section('content_header')
<br>
@stop

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row mayus">
                <div class="col-md-12">
                    <div class="card shadow " id="card">
                        <div class="card-header">
                            <h4>PERSONAL: <strong>{{$docente_act[0]->dcnt_name}} {{$docente_act[0]->dcnt_apell1}} {{$docente_act[0]->dcnt_apell2}}</strong></h4>
                        </div>
                        <div class="card-body">
                            {{-- dni --}}
                            <strong><i class="fas fa-id-card"></i> DNI</strong>
                            <p class="text-muted">{{$docente_act[0]->dcnt_dni}}</p>
                            <hr>
                            {{-- nombres --}}
                            <strong><i class="fas fa-user"></i> APELLIDOS Y NOMBRES</strong>
                            <p class="text-muted">{{$docente_act[0]->dcnt_name}} {{$docente_act[0]->dcnt_apell1}} {{$docente_act[0]->dcnt_apell2}}</p>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    {{-- cargo --}}
                                    <strong><i class="fas fa-user-tie"></i> cargo</strong>
                                    <p class="text-muted">{{$docente_act[0]->car_name}} </p>
                                </div>
                                <div class="col-md-4">
                                    {{-- estado --}}
                                    <strong><i class="fas fa-user-tie"></i> estado</strong>
                                    <p class="text-muted">{{$docente_act[0]->est_name}} </p>
                                </div>
                                <div class="col-md-4">
                                    {{-- ley --}}
                                    <strong><i class="fas fa-balance-scale"></i> ley</strong>
                                    <p class="text-muted">{{$docente_act[0]->ley_num}} - {{$docente_act[0]->ley_name}} </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- institucion --}}
                                    <strong><i class="fas fa-building"></i> institución / lugar</strong>
                                    <p class="text-muted">{{$docente_act[0]->tipo_inst}} - {{$docente_act[0]->inst_name}} / {{$docente_act[0]->inst_lugar}}</p>
                                </div>
                                <div class="col-md-6">
                                    {{-- caja --}}
                                    <strong><i class="fas fa-box"></i> caja</strong>
                                    <p class="text-muted">CAJA N°: {{$docente_act[0]->caja_num_let}} - {{$docente_act[0]->caja_tipo_per}}</p>
                                </div>
                            </div>
                            <hr>

                            {{-- para cesantes y pensionistas --}}
                            <div id="cesantes">
                                <h6><strong>DATOS DE CESE</strong></h6>

                                <div class="row">
                                    <div class="col-md-4">
                                        {{-- fecha --}}
                                        <strong><i class="fas fa-calendar"></i> Fecha del Cese</strong>
                                        <p class="text-muted">{{$docente_act[0]->dcnt_fec_ces}}</p>
                                    </div>

                                    <div class="col-md-4">
                                        {{-- rdr --}}
                                        <strong><i class="fas fa-file"></i> RDR</strong>
                                        <p class="text-muted">{{$docente_act[0]->dcnt_rdr}}</p>
                                    </div>

                                    <div class="col-md-4">
                                        {{-- tipo --}}
                                        <strong><i class="fas fa-inbox"></i> TIPO DE CESE</strong>
                                        <p class="text-muted">{{$docente_act[0]->dcnt_tip_ces}}</p>
                                    </div>

                                </div>

                                <hr>
                            </div>
                            {{-- para cesantes y pensionistas --}}

                            <div class="row">
                                <div class="col-md-4">
                                    {{-- celular --}}
                                    <strong><i class="fas fa-phone"></i> celular</strong>
                                    <p class="text-muted">{{$docente_act[0]->dcnt_cel}}</p>
                                </div>
                                <div class="col-md-4">
                                    {{-- coreo --}}
                                    <strong>@ correo</strong>
                                    <p class="text-muted">{{$docente_act[0]->dcnt_email}}</p>
                                </div>
                                <div class="col-md-4">
                                    {{-- coreo --}}
                                    <strong><i class="fas fa-eye"></i> observaciones</strong>
                                    <p class="text-muted">{{$docente_act[0]->dcnt_obs}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
        let cesantes = document.getElementById('cesantes');
        let estado = "{{ $docente_act[0]->id_est }}";
        let card = document.getElementById('card');
        if(estado == 1 || estado == 4){
            cesantes.setAttribute('hidden','');
        }else{
            cesantes.removeAttribute('hidden','');
        }

        

        switch(estado){
            case "1": 
            card.classList.add("card-info");
            break;
            case "2": 
            card.classList.add("card-warning");
            break;
            case "3": 
            card.classList.add("card-orange");
            break;
            case "4": 
            card.classList.add("card-purple");
            break;
        }
        
    </script>
@stop