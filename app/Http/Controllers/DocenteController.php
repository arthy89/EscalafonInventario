<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocenteRequest;
use App\Models\Institucion;
use App\Models\Ley;
use App\Models\Estado;
use App\Models\Docente;
use App\Models\Cargo;
use App\Models\Caja;
use DB;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // $puntos = DB::table("modelo")
        //         ->join("modelopuntos", function($join){
        //             $join->on("modelo.id_mod", "=", "modelopuntos.id_mod");
        //         })
        //         ->join("puntos", function($join){
        //             $join->on("modelopuntos.id_p", "=", "puntos.id_p");
        //         })
        //         ->select("modelo.id_mod", "puntos.id_p", "puntos.p_name", "puntos.p_mt", "puntos.p_svg")
        //         ->get();
        


        // $instituciones = Institucion::all();
        $instituciones = DB::table("institucion")
                        ->join("tipoinst", function($join){
                            $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
                        })
                        ->select("institucion.id_inst","institucion.inst_cod_mod","institucion.inst_name","institucion.inst_lugar","tipoinst.tipo_inst")
                        ->get();

        $cargos = Cargo::all();

        $estados = Estado::all();

        $leyes = Ley::all();

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

        return view('docentes.registrar_docente',compact('instituciones','cargos','estados','leyes','cajas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocenteRequest $request)
    {
        //
        // return $request->all();
        // $docente_u = Docente::select('id_dcnt')->orderBy('id_dcnt','desc')->first();

        // //!para obtener ultimo id
        // if($docente_u == null){
        //     $docente_id=1;
        // }else{
        //     $docente_id = $docente_u->id_dcnt + 1;
        // }

        $docente = Docente::create([
            'dcnt_dni' => $request->dni,
            'dcnt_name' => $request->nombres,
            'dcnt_apell1' => $request->apepaterno,
            'dcnt_apell2' => $request->apematerno,
            'dcnt_cel' => $request->celular,
            'dcnt_email' => $request->correo,
            'id_car' => $request->cargo,
            'id_est' => $request->estado,
            'id_ley' => $request->ley,
            'id_inst' => $request->institucion,
            'id_caja' => $request->caja,
            'usuario' => auth()->user()->name,
            'dcnt_fec_ces' => $request->fecha,
            'dcnt_tip_ces' => $request->tipo_cese,
            'dcnt_rdr' => $request->rdr,
            'dcnt_obs' => $request->observaciones,
        ]);

        return redirect()->route('registros');
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
    public function edit(Docente $docente)
    {
        //
        $instituciones = DB::table("institucion")
                        ->join("tipoinst", function($join){
                            $join->on("institucion.id_tipo","=","tipoinst.id_tipo");
                        })
                        ->select("institucion.id_inst","institucion.inst_cod_mod","institucion.inst_name","institucion.inst_lugar","tipoinst.tipo_inst")
                        ->get();

        $cargos = Cargo::all();

        $estados = Estado::all();

        $leyes = Ley::all();

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

        // return $docente;
        return view('docentes.editar_docente',compact('instituciones','cargos','estados','leyes','cajas','docente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocenteRequest $request, Docente $docente)
    {
        //
        // return $request;
        // return $docente;

        $docente->update([
            'dcnt_dni' => $request->dni,
            'dcnt_name' => $request->nombres,
            'dcnt_apell1' => $request->apepaterno,
            'dcnt_apell2' => $request->apematerno,
            'dcnt_cel' => $request->celular,
            'dcnt_email' => $request->correo,
            'id_car' => $request->cargo,
            'id_est' => $request->estado,
            'id_ley' => $request->ley,
            'id_inst' => $request->institucion,
            'id_caja' => $request->caja,
            'usuario' => auth()->user()->name,
            'dcnt_fec_ces' => $request->fecha,
            'dcnt_tip_ces' => $request->tipo_cese,
            'dcnt_rdr' => $request->rdr,
            'dcnt_obs' => $request->observaciones,
        ]);

        if($request->estado == 1){
            return redirect()->route('activos_list_ops');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        //
        // return $docente;
        $docente->delete();
        if($docente->id_est == 1){
            return redirect()->route('activos_list_ops');
        }
    }
}
