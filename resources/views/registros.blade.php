@extends('adminlte::page')

@section('title', 'Registros')

@section('content_header')
    <h1>REGISTROS</h1>
@stop

@section('content')
    <p>Mostrando todos los registros</p>
     <div class="container-fluid">
        <div class="content">
            <div class="row">

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
                        <a href="#" class="small-box-footer">
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
                        <a href="#" class="small-box-footer">
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
                        <a href="#" class="small-box-footer">
                        VER REGISTRO <i class="fas fa-arrow-circle-right"></i>
                        </a>
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
    <script> console.log('Hi!'); </script>
@stop