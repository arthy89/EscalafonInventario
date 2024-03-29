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
        // $cajas = DB::table('caja')
        //             ->join('estado', function($join){
        //                 $join->on('caja.id_est','=','estado.id_est');
        //             })
        //             ->join('institucion', function($join){
        //                 $join->on('caja.id_inst','=','institucion.id_inst');
        //             })
        //             ->join('tipoinst', function($join){
        //                 $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
        //             })
        //             ->select('caja.id_caja','caja.caja_num_let','caja.caja_tipo_per','estado.est_name','tipoinst.tipo_inst','institucion.inst_cod_mod','institucion.inst_name','institucion.inst_lugar','caja.caja_obs')
        //             ->orderBy('caja.caja_num_let','asc')->get();

        // return $cajas;

        // $caja_c = Caja::where('id_inst','=',null)->get();

        // $caja_c = DB::table('caja')
        //             ->join('estado', function($join){
        //                 $join->on('caja.id_est','=','estado.id_est');
        //             })
        //             ->where('id_inst','=',null)->select('caja.id_caja','caja.caja_num_let','caja.caja_tipo_per','estado.est_name','caja.caja_obs')
        //             ->orderBy('caja.caja_num_let','asc')->get();

        // $docentes = DB::table('docente')
        //             ->join('cargo', function($join){
        //                 $join->on('docente.id_car','=','cargo.id_car');
        //             })
        //             ->join('estado', function($join){
        //                 $join->on('docente.id_est','=','estado.id_est');
        //             })
        //             ->join('ley', function($join){
        //                 $join->on('docente.id_ley','=','ley.id_ley');
        //             })
        //             ->join('institucion', function($join){
        //                 $join->on('docente.id_inst','=','institucion.id_inst');
        //             })
        //             ->join('caja', function($join){
        //                 $join->on('docente.id_caja','=','caja.id_caja');
        //             })
        //             ->join('tipoinst', function($join){
        //                 $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
        //             })
        //             ->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.id_caja','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();
        // return $docentes;

        // cantidad de activos 
        $total_activos = DB::table('caja')->where('id_est',1)->count();

        // cantidad de cesantes 
        $total_cesantes = DB::table('caja')->where('id_est',2)->count();

        // cantidad de pensionistas 
        $total_pensionistas = DB::table('caja')->where('id_est',3)->count();

        // cantidad de nolegix 
        $total_nolegix = DB::table('caja')->where('id_est',4)->count();

        $total_t = DB::table('caja')->count();

        // return $total_t;
        return view('cajas.index', compact('total_activos','total_cesantes','total_pensionistas','total_nolegix','total_t'));
    }

    public function caja_t_list(){
        $cajas = DB::table('caja')
                ->join('estado', function($join){
                    $join->on('caja.id_est','=','estado.id_est');
                })
                ->select('id_caja','caja.caja_num_let', 'caja.caja_tipo_per', 'estado.est_name','caja.caja_obs')->get();
        // return $cajas;
        return view('cajas.listado_caja.caja_todo_list', compact('cajas'));
    }

    public function caja_a_list(){
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
        
        //return $cajas;
        return view('cajas.listado_caja.caja_activos_list', compact('cajas'));
    }

    public function caja_c_list(){
        $cajas = DB::table('caja')
                ->join('estado', function($join){
                    $join->on('caja.id_est','=','estado.id_est');
                })
                ->where('caja.id_est',2)->select('id_caja','caja.caja_num_let', 'caja.caja_tipo_per', 'estado.est_name','caja.caja_obs')->get();
        //return $cajas;
        return view('cajas.listado_caja.caja_cesantes_list', compact('cajas'));
    }

    public function caja_p_list(){
        $cajas = DB::table('caja')
                ->join('estado', function($join){
                    $join->on('caja.id_est','=','estado.id_est');
                })
                ->where('caja.id_est',3)->select('id_caja','caja.caja_num_let', 'caja.caja_tipo_per', 'estado.est_name','caja.caja_obs')->get();
        //return $cajas;
        return view('cajas.listado_caja.caja_pensionistas_list', compact('cajas'));
    }

    public function caja_nl_list(){
        $cajas = DB::table('caja')
                ->join('estado', function($join){
                    $join->on('caja.id_est','=','estado.id_est');
                })
                ->where('caja.id_est',4)->select('id_caja','caja.caja_num_let', 'caja.caja_tipo_per', 'estado.est_name','caja.caja_obs')->get();
        //return $cajas;
        return view('cajas.listado_caja.caja_nolegix_list', compact('cajas'));
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
                        ->orderBy('institucion.inst_name','asc')
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
    public function show(Caja $caja){
        //
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
                    ->where('docente.id_caja',$caja->id_caja)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        $caja_act = DB::table('caja')
                    ->join('estado', function($join){
                        $join->on('caja.id_est','=','estado.id_est');
                    })
                    ->join('institucion', function($join){
                        $join->on('caja.id_inst','=','institucion.id_inst');
                    })
                    ->join('tipoinst', function($join){
                        $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
                    })
                    ->where('caja.id_caja',$caja->id_caja)->select('caja.caja_num_let','caja.caja_tipo_per', 'estado.id_est','estado.est_name','tipoinst.tipo_inst','institucion.inst_name','institucion.inst_lugar','caja.caja_obs')->get();
        // return $caja_act[0]->id_est;
        //return $caja;

        
        return view('cajas.detalle_caja', compact('docentes', 'caja_act', 'caja'));
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
                        ->orderBy('institucion.inst_name','asc')
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
