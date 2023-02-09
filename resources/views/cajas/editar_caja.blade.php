@extends('adminlte::page')

@section('title', 'Editar Caja')
<style>
    input, textarea{
       text-transform: uppercase;
    }
</style>
<link href="../../../resources/select2/select2.min.css" rel="stylesheet" />
@section('content_header')
    <br>
@stop

@section('content')
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <form action=" {{route('actualizar_caja', $caja)}} " method="POST">

                        @csrf

                        @method('put')


                        <div class="card card-orange card-outline">
                            <div class="card-header">
                                <h3><strong><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-box"></i>&nbsp; EDITAR CAJA N° < {{$caja->caja_num_let}} > </strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- NOMBRE O NUM DE LA CAJA --}}
                                    <div class="col-md-2">
                                        @if ($errors->has('num_let'))
                                            <div class="form-group">
                                                <label for="">NÚMERO O LETRAS DE LA CAJA</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-inbox"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control is-invalid" placeholder="001 / A-B-C" name="num_let" value=" {{ $caja->caja_num_let }} ">
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="">NÚMERO O LETRAS DE LA CAJA</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-inbox"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="001 / A-B-C" name="num_let" value="{{old('num_let',$caja->caja_num_let)}}">
                                                </div>
                                            </div>   
                                        @endif
                                    </div>

                                    {{-- TIPO DE CAJA --}}
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">TIPO DE CAJA</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-inbox"></i></span>
                                                </div>
                                                {{-- <input type="text" class="form-control is-invalid" placeholder="Nombres" name="nombre"> --}}
                                                <select class="js-example-basic-single" name="tipo_personal" style="width: 80%" id="tipo_caja">
                                                    <option value="DOCENTES">DOCENTES</option>
                                                    <option value="ADMINISTRATIVOS">ADMINISTRATIVOS</option>
                                                    <option value="DOCENTES Y ADMINISTRATIVOS">DOCENTES Y ADMINISTRATIVOS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ESTADO --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">ESTADO</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
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

                                    {{-- INSTITUCION --}}
                                    <div class="col-md-4" id="institucion_2">
                                        <div class="form-group">
                                            <label for="">INSTITUCIÓN</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                </div>
                                                <select class="js-example-basic-single" name="institucion" style="width: 85%" id="inst_select">
                                                    @foreach ($instituciones as $inst)
                                                        @if ($inst->tipo_inst == "SEDE")
                                                            <option value="{{$inst->id_inst}}">{{ $inst->inst_name}} - {{ $inst->inst_lugar}} - {{ $inst->tipo_inst}}</option>
                                                        @else
                                                            <option value="{{ $inst->id_inst}}">{{ $inst->tipo_inst}} - {{ $inst->inst_cod_mod}} - {{ $inst->inst_name}} - {{ $inst->inst_lugar}} </option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- OBSERVACIONES --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">OBSERVACIONES</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                                </div>
                                                <textarea class="form-control" name="observaciones" placeholder="OBSERVACIONES REFERENTE A LA CAJA"  rows="2">{{old('observaciones', $caja->caja_obs)}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> &nbsp; GUARDAR CAMBIOS</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
    <script src="../../../resources/select2/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            // select tipo caja
            $('#tipo_caja').val("{{$caja->caja_tipo_per}}");
            $('#tipo_caja').select2().trigger('change');

            // select estado
            $('#estado').val("{{$caja->id_est}}");
            $('#estado').select2().trigger('change');

            // select institucion
            $('#inst_select').val({{$caja->id_inst}});
            $('#inst_select').select2().trigger('change');
        });
        
    console.log({{$caja->id_inst}});
    </script>
    <script>
        function cambiar(){
            let estado = document.getElementById('estado').value;
        
            // document.getElementById('textop').innerText = `Seleccionado ${estado_select}`;
            let institucion = document.getElementById('institucion_2');
            let inst_select = document.getElementById('inst_select');
            if(estado == 1){
                institucion.removeAttribute('hidden','');
                inst_select.removeAttribute('disabled','');
            }else{
                institucion.setAttribute('hidden','');
                inst_select.setAttribute('disabled','');

            }
        }
    </script>
@stop