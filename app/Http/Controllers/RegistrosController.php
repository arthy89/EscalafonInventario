<?php

namespace App\Http\Controllers;
use Illuminate\Middleware\Authenticate;

use Illuminate\Http\Request;
use App\Models\Institucion;
use App\Models\Ley;
use App\Models\Estado;
use App\Models\Docente;
use App\Models\Cargo;
use App\Models\Caja;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;


class RegistrosController extends Controller
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

        // cantidad de activos 
        $total_activos = DB::table('docente')->where('id_est',1)->count();

        // cantidad de cesantes 
        $total_cesantes = DB::table('docente')->where('id_est',2)->count();

        // cantidad de pensionistas 
        $total_pensionistas = DB::table('docente')->where('id_est',3)->count();

        // cantidad de nolegix 
        $total_nolegix = DB::table('docente')->where('id_est',4)->count();

        $total_t = DB::table('docente')->count();

        return view('registros', compact('total_activos','total_cesantes','total_pensionistas','total_nolegix','total_t'));
    }

    public function todo_list(){
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
                    ->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        return view('listas.todo', compact('docentes'));

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
                    ->where('docente.id_est',1)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();
        
        // return $docentes;

        
        // return $activos = $docentes
        return view('listas.activos.lista_ops', compact('docentes'));
    }

    public function cesantes_list_ops()
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
                    ->where('docente.id_est',2)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        return view('listas.cesantes.lista_ops', compact('docentes'));
    }

    public function pensionistas_list_ops()
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
                    ->where('docente.id_est',3)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        return view('listas.pensionistas.lista_ops', compact('docentes'));
    }

    public function nolegix_list_ops()
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
                    ->where('docente.id_est',4)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        return view('listas.nolegix.lista_ops', compact('docentes'));
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

    // GENERAL
    public function generar_pdf_todo()
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
                    ->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.id_caja','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        $pdf = Pdf::loadView('pdf.descargar_pdf_todo', array('docentes' => $docentes));

        return $pdf->stream("Lista General.pdf", [ "Attachment" => true]);
    }

    // ACTIVOS
    public function generar_pdf()
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
                    ->where('docente.id_est',1)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.id_caja','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

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
                    ->where('caja.id_est',1)->select('caja.id_caja','caja.caja_num_let','caja.caja_tipo_per','estado.est_name','tipoinst.tipo_inst','institucion.inst_cod_mod','institucion.inst_name','institucion.inst_lugar','caja.caja_obs')
                    ->orderBy('caja.caja_num_let','asc')->get();

        $pdf = Pdf::loadView('pdf.descargar_pdf', array('cajas' => $cajas, 'docentes' => $docentes));

        return $pdf->stream("Lista Activos.pdf", [ "Attachment" => true]);
    }

    public function generar_pdf_cesantes()
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
                    ->where('docente.id_est',2)->select('docente.id_caja','docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.id_caja','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        $cajas = DB::table('caja')
                    ->join('estado', function($join){
                        $join->on('caja.id_est','=','estado.id_est');
                    })
                    ->where('caja.id_est',2)->select('caja.id_caja','caja.caja_num_let','caja.caja_tipo_per','estado.est_name','caja.caja_obs')
                    ->orderBy('caja.caja_num_let','asc')->get();
        return $docentes;
        return view('pdf.descargar_pdf_cesantes', compact('cajas', 'docentes'));

        $pdf = Pdf::loadView('pdf.descargar_pdf_cesantes', array('cajas' => $cajas, 'docentes' => $docentes));
        $pdf->set_paper("A4", "landscape");

        // return $docentes;

        return $pdf->stream("Lista Cesantes.pdf", [ "Attachment" => true]);
    }

    public function generar_pdf_pensionistas()
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
                    ->where('docente.id_est',3)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.id_caja','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        $cajas = DB::table('caja')
                    ->join('estado', function($join){
                        $join->on('caja.id_est','=','estado.id_est');
                    })
                    ->where('caja.id_est',3)->select('caja.id_caja','caja.caja_num_let','caja.caja_tipo_per','estado.est_name','caja.caja_obs')
                    ->orderBy('caja.caja_num_let','asc')->get();

        $pdf = Pdf::loadView('pdf.descargar_pdf_pensionistas', array('cajas' => $cajas, 'docentes' => $docentes));
        $pdf->set_paper("A4", "landscape");

        return $pdf->stream("Lista Pensionistas.pdf", [ "Attachment" => true]);
    }

    public function generar_pdf_nolegix()
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
                    ->where('docente.id_est',4)->select('docente.id_dcnt','docente.dcnt_dni','docente.dcnt_name','docente.dcnt_apell1','docente.dcnt_apell2','docente.dcnt_fec_ces','docente.dcnt_rdr','docente.dcnt_tip_ces','docente.dcnt_cel','docente.dcnt_email','cargo.car_name','estado.est_name','ley.ley_num','ley.ley_name','institucion.inst_name','institucion.inst_lugar','tipoinst.tipo_inst','caja.id_caja','caja.caja_num_let','docente.dcnt_obs','docente.usuario')->orderBy('docente.dcnt_apell1','asc')->get();

        $cajas = DB::table('caja')
                    ->join('estado', function($join){
                        $join->on('caja.id_est','=','estado.id_est');
                    })
                    ->where('caja.id_est',4)->select('caja.id_caja','caja.caja_num_let','caja.caja_tipo_per','estado.est_name','caja.caja_obs')
                    ->orderBy('caja.caja_num_let','asc')->get();

        $pdf = Pdf::loadView('pdf.descargar_pdf_nolegix', array('cajas' => $cajas, 'docentes' => $docentes));
        $pdf->set_paper("A4", "landscape");

        return $pdf->stream("Lista No Legix.pdf", [ "Attachment" => true]);
    }
}
