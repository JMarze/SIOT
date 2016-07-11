<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;

use App\Solicitud;
use App\DocumentoDigital;
use App\Codigo;
use App\EtapaInicio;

class EtapaInicioController extends Controller
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
    public function create(Request $request)
    {
        $solicitud = Solicitud::find($request->solicitud);
        $documentosDigitales = DocumentoDigital::orderBy('id', 'ASC')->get();
        return view('etapa_inicio.create')->with('solicitud', $solicitud)->with('documentosDigitales', $documentosDigitales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoCodigo = Codigo::get()->first();
        if ($nuevoCodigo->año == Carbon::now()->year){
            $nuevoCodigo->numero += 1;
        }else{
            $nuevoCodigo->numero = 1;
        }
        $nuevoCodigo->año = Carbon::now()->year;
        $nuevoCodigo->update();

        $solicitud = Solicitud::find($request->solicitud);
        $dia = (Carbon::now()->day <= 9)?"0".Carbon::now()->day:Carbon::now()->day;
        $mes = (Carbon::now()->month <= 9)?"0".Carbon::now()->month:Carbon::now()->month;
        $anio = substr(Carbon::now()->year, -2);
        $numeral = Codigo::get()->first();
        switch (strlen($numeral->numero)){
            case 1:
                $correlativo = "000" . $numeral->numero;
                break;
            case 2:
                $correlativo = "00" . $numeral->numero;
                break;
            case 3:
                $correlativo = "0" . $numeral->numero;
                break;
            default:
                $correlativo = $numeral->numero;
                break;
        }
        $codigo = $dia . $mes . $anio . "-MA.VAICOT.DGLOTAR-" . $solicitud->tipo_limite . "-" . $correlativo . "/" . $numeral->año;

        $etapaInicio = new EtapaInicio($request->all());
        $etapaInicio->codigo = $codigo;
        $etapaInicio->solicitud_id = $request->solicitud;
        $etapaInicio->save();

        if ($request->documento_1 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(1, ['cumple' => 1]);
        }elseif ($request->documento_1 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(1, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(1, ['cumple' => null]);
        }

        if ($request->documento_2 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(2, ['cumple' => 1]);
        }elseif ($request->documento_2 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(2, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(2, ['cumple' => null]);
        }

        if ($request->documento_3 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(3, ['cumple' => 1]);
        }elseif ($request->documento_3 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(3, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(3, ['cumple' => null]);
        }

        if ($request->documento_4 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(4, ['cumple' => 1]);
        }elseif ($request->documento_4 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(4, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(4, ['cumple' => null]);
        }

        if ($request->documento_5 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(5, ['cumple' => 1]);
        }elseif ($request->documento_5 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(5, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(5, ['cumple' => null]);
        }

        if ($request->documento_6 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(6, ['cumple' => 1]);
        }elseif ($request->documento_6 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(6, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(6, ['cumple' => null]);
        }

        if ($request->documento_7 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(7, ['cumple' => 1]);
        }elseif ($request->documento_7 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(7, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(7, ['cumple' => null]);
        }

        if ($request->documento_8 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(8, ['cumple' => 1]);
        }elseif ($request->documento_8 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(8, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(8, ['cumple' => null]);
        }

        if ($request->documento_9 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(9, ['cumple' => 1]);
        }elseif ($request->documento_9 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(9, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(9, ['cumple' => null]);
        }

        if ($request->documento_10 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(10, ['cumple' => 1]);
        }elseif ($request->documento_10 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(10, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(10, ['cumple' => null]);
        }

        if ($request->documento_11 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(11, ['cumple' => 1]);
        }elseif ($request->documento_11 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(11, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(11, ['cumple' => null]);
        }

        if ($request->documento_12 == 'cumple'){
            $etapaInicio->documentosDigitales()->attach(12, ['cumple' => 1]);
        }elseif ($request->documento_12 == 'no_cumple'){
            $etapaInicio->documentosDigitales()->attach(12, ['cumple' => 0]);
        }else{
            $etapaInicio->documentosDigitales()->attach(12, ['cumple' => null]);
        }
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

    /**
     * Download .zip
     *
     *
     *
     */
    public function descargarSolicitante($solicitudId){
        $solicitud = Solicitud::find($solicitudId);
        $archivo = \Storage::disk('local')->get($solicitud->documentos_solicitante);
        return response($archivo, 200)->header('Content-Type', 'application/zip');
    }

    public function descargarTecnico($solicitudId){
        $solicitud = Solicitud::find($solicitudId);
        $archivo = \Storage::disk('local')->get($solicitud->documentos_tecnicos);
        return response($archivo, 200)->header('Content-Type', 'application/zip');
    }
}
