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
        return view('cajas.index', compact('cajas'));
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
        return view('cajas.editar_caja', compact('caja'));
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
