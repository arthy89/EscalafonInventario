@extends('adminlte::page')

@section('title', 'Registros')

@section('content_header')
<small></small>
@stop

@section('content')
     <div class="container-fluid">
        <div class="content">
            <h1>TODOS LOS REGISTROS</h1>
            <div class="row">
                {{-- ACTIVOS --}}
                <div class="col-md-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$total_t}}</h3>
                            <p><h4><strong>TODOS LOS REGISTROS</strong></h4></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <a href="{{route('todo_list')}}" class="small-box-footer">
                        VER REGISTROS <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <h1 class="text-center">REGISTRO POR PARTES</h1>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop