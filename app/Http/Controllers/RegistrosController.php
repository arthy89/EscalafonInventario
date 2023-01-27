<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;
use App\Models\Ley;
use App\Models\Estado;
use App\Models\Docente;
use App\Models\Cargo;
use App\Models\Caja;
use DB;


class RegistrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cajas = DB::table('caja')
                    ->join('estado', function($join){
                        $join->on('caja.id_est','=','estado.id_est');
                    })
                    ->join('institucion', function($join){
                        $join->on('caja.id_inst','=','institucion.id_inst');
                    })
                    ->join('tipoinst', function($join){
                        $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
                    })
                    ->select('caja.id_caja','caja.caja_num_let','caja.caja_tipo_per','estado.est_name','tipoinst.tipo_inst','institucion.inst_cod_mod','institucion.inst_name','institucion.inst_lugar','caja.caja_obs')
                    ->orderBy('caja.caja_num_let','asc')->get();

        // cantidad de activos 
        $total_activos = DB::table('docente')->where('id_est',1)->count();

        // cantidad de cesantes 
        $total_cesantes = DB::table('docente')->where('id_est',2)->count();

        // cantidad de pensionistas 
        $total_pensionistas = DB::table('docente')->where('id_est',3)->count();

        // cantidad de nolegix 
        $total_nolegix = DB::table('docente')->where('id_est',4)->count();

        return view('registros', compact('total_activos','total_cesantes','total_pensionistas','total_nolegix'));
    }

    public function activos_list_ops()
    {
        $docentes = DB::table('docente')
                    ->join('cargo', function($join){
                        $join->on('docente.id_car','=','cargo.id_car');
                    })
                    ->join('estado', function($join){
                        $join->on('docente.id_est','=','estado.id_est');
                    })
                    ->join('ley', function($join){
                        $join->on('docente.id_ley','=','ley.id_ley');
                    })
                    ->join('institucion', function($join){
                        $join->on('docente.id_inst','=','institucion.id_inst');
                    })
                    ->join('caja', function($join){
                        $join->on('docente.id_caja','=','caja.id_caja');
                    })
                    ->join('tipoinst', function($join){
                        $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
                    })
                    ->where('docente.id_est',1)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();
        
        // return $docentes;

        
        // return $activos = $docentes
        return view('listas.activos.lista_ops', compact('docentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
