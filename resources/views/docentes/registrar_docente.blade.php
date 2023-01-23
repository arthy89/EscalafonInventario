@extends('adminlte::page')

@section('title', 'Nuevo')

<style>
    input{
       text-transform: uppercase;
    }
</style>
<link href="resources/select2/select2.min.css" rel="stylesheet" />
@section('content_header')
    {{-- <h1>Nuevo Docente</h1> --}}
    @foreach ($instituciones as $inst)
        {{ $inst->inst_cod_mod}}
    @endforeach
    <br>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3><strong><i class="fas fa-edit"></i> Registrar Nuevo</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    {{-- DNI --}}
                                    @if ($errors->has('dni'))
                                        <div class="form-group">
                                            <label for="">DNI</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control is-invalid" placeholder="DNI" name="dni" onkeypress='validate(event)' maxlength="8">
                                            </div>
                                        </div>
                                    @else    
                                        <div class="form-group">
                                            <label for="">DNI</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="DNI" name="dni" value="{{old('dni')}}" onkeypress='validate(event)' maxlength="8">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                {{-- APELLLIDO PATERNO --}}
                                <div class="col-md-4">
                                    @if ($errors->has('apepaterno'))
                                        <div class="form-group">
                                            <label for="">APELLIDO PATERNO</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control is-invalid" placeholder="Apellido paterno" name="apepaterno">
                                            </div>
                                        </div>
                                    @else    
                                        <div class="form-group">
                                            <label for="">APELLIDO PATERNO</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Apellido paterno" name="apepaterno" value="{{old('apepaterno')}}">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- APELLLIDO MATERNO --}}
                                <div class="col-md-4">
                                    @if ($errors->has('apematerno'))
                                        <div class="form-group">
                                            <label for="">APELLIDO MATERNO</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control is-invalid" placeholder="Apellido MATERNO" name="apematerno">
                                            </div>
                                        </div>
                                    @else    
                                        <div class="form-group">
                                            <label for="">APELLIDO MATERNO</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Apellido MATERNO" name="apematerno" value="{{old('apematerno')}}">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- NOMBRES --}}
                                <div class="col-md-4">
                                    @if ($errors->has('nombres'))
                                        <div class="form-group">
                                            <label for="">NOMBRES</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control is-invalid" placeholder="Nombres" name="nombres">
                                            </div>
                                        </div>
                                    @else    
                                        <div class="form-group">
                                            <label for="">NOMBRES</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Nombres" name="nombres" value="{{old('nombres')}}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                            </div>

                            <div class="row">
                                {{-- INSTITUCION --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">INSTITUCIÓN</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            </div>
                                            <select class="js-example-basic-single" name="institucion" style="width: 90%">
                                                @foreach ($instituciones as $inst)
                                                    <option value="{{ $inst->id_inst}}">{{ $inst->tipo_inst}} - {{ $inst->inst_cod_mod}} - {{ $inst->inst_name}} - {{ $inst->inst_lugar}} </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                {{-- CARGO --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">CARGO</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                            </div>
                                            <select class="js-example-basic-single" name="cargo" style="width: 80%">
                                                
                                                @foreach ($cargos as $cargo)
                                                    <option value="{{$cargo->id_car}}">{{$cargo->car_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- ESTADO --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">ESTADO</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            {{-- <input type="text" class="form-control is-invalid" placeholder="Nombres" name="nombre"> --}}
                                            <select class="js-example-basic-single" name="estado" style="width: 80%" id="estado" onchange="cambiar()">
                                                @foreach ($estados as $estado)
                                                    <option value="{{$estado->id_est}}">{{$estado->est_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="campos_cese" hidden>
                                {{-- FECHA DE CESE --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">FECHA DEL CESE</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="FECHA DEL CESE" name="fecha" value="{{old('fecha')}}">
                                        </div>
                                    </div>
                                </div>

                                {{-- RDR --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">RDR</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="FECHA DEL CESE" name="rdr" value="{{old('rdr')}}">
                                        </div>
                                    </div>
                                </div>

                                {{-- TIPO DE CESE  --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">TIPO DE CESE</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-inbox"></i></span>
                                            </div>
                                            {{-- <input type="text" class="form-control is-invalid" placeholder="Nombres" name="nombre"> --}}
                                            <select class="js-example-basic-single" name="tipo_cese" style="width: 90%">
                                                <option value=" ">SELECCIONE EL TIPO DE CESE</option>
                                                <option value="CESE A SOLICITUD">CESE A SOLICITUD</option>
                                                <option value="POR LIMITE DE EDAD">POR LIMITE DE EDAD</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- CAJA --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">CAJA</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                            </div>
                                            {{-- <input type="text" class="form-control is-invalid" placeholder="Nombres" name="nombre"> --}}
                                            <select class="js-example-basic-single" name="caja" style="width: 90%">
                                                <option value="AL">Alabama</option>
                                                <option value="WY">Wyoming</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                {{-- LEY --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">LEY</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                            </div>
                                            {{-- <input type="text" class="form-control is-invalid" placeholder="Nombres" name="nombre"> --}}
                                            <select class="js-example-basic-single" name="ley" style="width: 90%">
                                                @foreach ($leyes as $ley)
                                                    <option value="{{$ley->id_ley}}">{{$ley->ley_num}} - {{$ley->ley_name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    {{-- CELULAR --}}
                                    <div class="form-group">
                                        <label for="">CELULAR</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Celular" name="celular" value="{{old('celular')}}" onkeypress='validate(event)' maxlength="9">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    {{-- CORREO --}}
                                    <div class="form-group">
                                        <label for="">CORREO</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><strong>@</strong></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="CORREO" name="correo" value="{{old('correo')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp; Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="resources/select2/select2.min.js"></script>
    <script>
        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        

        function cambiar(){
            let estado_select = document.getElementById('estado').value;
        
            // document.getElementById('textop').innerText = `Seleccionado ${estado_select}`;
            let campos_cese = document.getElementById('campos_cese');
            if(estado_select == 1 || estado_select == 4){
                campos_cese.setAttribute('hidden','');
            }else if(estado_select == 2 || estado_select == 3){
                campos_cese.removeAttribute('hidden','');
            }
        }
        
    </script>
@stop