<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CajaRequest;
use App\Models\Institucion;
use App\Models\Ley;
use App\Models\Estado;
use App\Models\Docente;
use App\Models\Cargo;
use App\Models\Caja;
use DB;

class CajaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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

        // return $cajas;

        // $caja_c = Caja::where('id_inst','=',null)->get();

        $caja_c = DB::table('caja')
                    ->join('estado', function($join){
                        $join->on('caja.id_est','=','estado.id_est');
                    })
                    ->where('id_inst','=',null)->select('caja.id_caja','caja.caja_num_let','caja.caja_tipo_per','estado.est_name','caja.caja_obs')
                    ->orderBy('caja.caja_num_let','asc')->get();

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
                    ->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.id_caja','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        return view('cajas.index', compact('cajas','caja_c','docentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $instituciones = DB::table("institucion")
                        ->join("tipoinst", function($join){
                            $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
                        })
                        ->select("institucion.id_inst","institucion.inst_cod_mod","institucion.inst_name","institucion.inst_lugar","tipoinst.tipo_inst")
                        ->get();
        
        $estados = Estado::all();

        return view('cajas.registrar_caja', compact('instituciones','estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CajaRequest $request)
    {
        //
        // ultima caja
        $caja_u = Caja::select('id_caja')->orderBy('id_caja','desc')->first();

        //para obtener ultimo id
        if($caja_u == null){
            $caja_id=1;
        }else{
            $caja_id = $caja_u->id_caja + 1;
        }
        // return $request->all();

        $caja = Caja::create([
            'id_caja' => $caja_id,
            'caja_num_let' => $request->num_let,
            'caja_tipo_per' => $request->tipo_personal,
            'id_est' => $request->estado,
            'id_inst' => $request->institucion,
            'caja_obs'=> $request->observaciones,

        ]);
        // return $request;
        return redirect()->route('cajas');
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
    public function edit(Caja $caja)
    {
        //
        
        $instituciones = DB::table("institucion")
                        ->join("tipoinst", function($join){
                            $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
                        })
                        ->select("institucion.id_inst","institucion.inst_cod_mod","institucion.inst_name","institucion.inst_lugar","tipoinst.tipo_inst")
                        ->get();
        
        $estados = Estado::all();

        // return $caja;

        return view('cajas.editar_caja', compact('caja','estados','instituciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CajaRequest $request, Caja $caja)
    {
        //
        
        // return $caja;
        $caja->update([
            'caja_num_let' => $request->num_let,
            'caja_tipo_per' => $request->tipo_personal,
            'id_est' => $request->estado,
            'id_inst' => $request->institucion,
            'caja_obs' => $request->observaciones,
        ]);

        return redirect()->route('cajas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caja $caja)
    {
        //
        $caja->delete();
        return redirect()->route('cajas');
    }
}
