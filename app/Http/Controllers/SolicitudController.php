<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Http\Requests\SolicitudRequest;

use App\Solicitud;
use App\Municipio;
use App\DocumentoDigital;
use App\Codigo;
use App\EtapaInicio;

class SolicitudController extends Controller
{
    public function __construct(){
        $this->middleware('role.user', ['only' => ['create', 'store', 'edit', 'destroy', 'uploadSolicitud', 'uploadTecnico']]);

        Carbon::setLocale('es');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitud::orderBy('updated_at', 'DESC')->paginate(12);
        return view('solicitud.index')->with('solicitudes', $solicitudes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = Municipio::orderBy('codigo', 'asc')->get();
        return view('solicitud.create')->with('municipios', $municipios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitudRequest $request)
    {
        try{
            $solicitud = new Solicitud($request->all());
            $solicitud->user_id = $request->user()->id;
            $solicitud->estado = 'solicitud';
            $solicitud->save();
            $solicitud->municipios()->attach($request->municipios);

            $documentosDigitales = DocumentoDigital::orderBy('id', 'ASC')->lists('id')->toArray();
            $solicitud->documentosSolicitud()->sync($documentosDigitales);

            flash()->success('Solicitud de Autoridad: '.$solicitud->nombre_solicitante.' fué registrada...');
        }catch(\Exception $ex){
            flash()->error('La solicitud no fué registrada. Ocurrió un problema en la transacción...' . $ex->getMessage());
        }finally{
            return redirect()->route('solicitud.index');
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
        /*if ($request->ajax()){
            try{
                $solicitud = Solicitud::find($id);
                return response()->json([
                    'solicitud' => $solicitud,
                ]);
            }catch(\Exception $ex){
                flash()->error('Se presentó un problema al buscar datos... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$solicitud = Solicitud::find($id);
        $documentosDigitales = collect();
        foreach(DocumentoDigital::get() as $documentoDigital){
            $id = $documentoDigital->id;
            $descripcion = $documentoDigital->descripcion;
            $descripcion = str_replace('[texto]', ($solicitud->tipo_limite == 'M')?$documentoDigital->texto_intra:$documentoDigital->texto_inter, $descripcion);
            $articulo = ($solicitud->tipo_limite == 'M')?$documentoDigital->articulo_intra:$documentoDigital->articulo_inter;

            $documentosDigitales->push(['id' => $id, 'descripcion' => $descripcion, 'articulo' => $articulo]);
        }
        $documentosDigitales->sortBy('articulo');
        $documentosDigitales->toJson();
        return view('solicitud.edit')->with('solicitud', $solicitud)->with('documentosDigitales', $documentosDigitales);*/
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
        try{
            $solicitud = Solicitud::find($id);
            $solicitud->fill($request->all());
            $solicitud->user_id = $request->user()->id;
            $solicitud->update();
            flash()->success('Solicitud de Autoridad: '.$solicitud->nombre_solicitante.' pasó al estado: '.$solicitud->estado.'...');

            if($solicitud->estado == 'admision'){
                // Generación de código
                $nuevoCodigo = Codigo::get()->first();
                if ($nuevoCodigo->año == Carbon::now()->year){
                    $nuevoCodigo->numero += 1;
                }else{
                    $nuevoCodigo->numero = 1;
                }
                $nuevoCodigo->año = Carbon::now()->year;
                $nuevoCodigo->update();

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

                $etapaInicio = new EtapaInicio();
                $etapaInicio->codigo = $codigo;
                $etapaInicio->solicitud_id = $solicitud->id;
                $etapaInicio->save();
            }

        }catch(\Exception $ex){
            flash()->error('La solicitud no fué enviada. Ocurrió un problema en la transacción...' . $ex->getMessage());
        }finally{
            return redirect()->route('solicitud.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()){
            try{
                $solicitud = Solicitud::find($id);
                $solicitud->documentosSolicitud()->detach();
                $solicitud->documentosAdicional()->detach();
                $solicitud->documentosSubsanacion()->detach();
                $solicitud->delete();

                flash()->error('Se eliminó la solicitud de: '.$solicitud->nombre_solicitante);
                return response()->json([
                    'mensaje' => $solicitud->id,
                ]);
            }catch(\Exception $ex){
                flash()->error('Se presentó un problema al eliminar... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function llenarSolicitud(Request $request, $solicitudId){
        $solicitud = Solicitud::find($solicitudId);
        $documentosFaltantes = $solicitud->documentosSolicitud()->whereNull('documento_digital_solicitud.archivo')->count();
        return view('solicitud.solicitar')->with('solicitud', $solicitud)->with('documentosFaltantes', $documentosFaltantes);
    }

    public function subirSolicitud(Request $request, $solicitudId, $documentoDigital)
    {
        $this->validate($request, [
            'archivo' => 'required|mimes:zip',
            'fojas_de' => 'required|numeric|min:1',
            'fojas_a' => 'required|numeric|min:1',
        ]);
        if ($request->ajax()){
            try{
                $solicitud = Solicitud::find($solicitudId);

                $nombreArchivo = $solicitud->id . "-" . $documentoDigital . "-" . Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . "-" . Carbon::now()->hour . Carbon::now()->minute . Carbon::now()->second . "." . $request->archivo->getClientOriginalExtension();

                \Storage::disk('local')->put('Solicitud-'.$solicitud->id.'/'.$nombreArchivo, \File::get($request->archivo));

                $solicitud->documentosSolicitud()->updateExistingPivot($documentoDigital, ['fojas_de' => $request['fojas_de'], 'fojas_a' => $request['fojas_a'], 'archivo' => $nombreArchivo, 'fecha' => Carbon::now()]);
                $solicitud->update();
                flash()->success('El archivo se subió exitosamente...');
                return response()->json([
                    'mensaje' => $nombreArchivo,
                ]);
            }catch(\Exception $ex){
                flash()->error('Se presentó un problema al subir el archivo... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function descargarDocumento(Request $request, $solicitudId, $documentoDigital){
        $solicitud = Solicitud::find($solicitudId);
        $documento = \Storage::disk('local')->get('Solicitud-'.$solicitud->id.'/'.$documentoDigital);
        return response($documento, 200)->header('Content-Type', 'application/zip');
    }

    public function revisarSolicitud(Request $request, $solicitudId){
        $solicitud = Solicitud::find($solicitudId);
        $revisionesFaltantes = $solicitud->documentosSolicitud()->where('documento_digital_solicitud.estado', '=', 'revision')->count();
        return view('solicitud.revisar')->with('solicitud', $solicitud)->with('revisionesFaltantes', $revisionesFaltantes);
    }

    public function revisionSolicitud(Request $request, $solicitudId){
        $solicitud = Solicitud::find($solicitudId);
        for($i=0; $i<count($request->documento); $i++){
            if($request->cumple[$i] != ''){
                $solicitud->documentosSolicitud()->updateExistingPivot($request->documento[$i], ['cumple' => $request->cumple[$i], 'estado' => $request->estado[$i], 'observaciones' => ($request->observacion[$i] != '')?$request->observacion[$i]:null]);
                switch($request->estado[$i]){
                    case 'adicional':
                        $solicitud->documentosSubsanacion()->detach($request->documento[$i]);
                        $solicitud->documentosAdicional()->detach($request->documento[$i]);
                        $solicitud->documentosAdicional()->attach($request->documento[$i]);
                        break;
                    case 'subsanacion':
                        $solicitud->documentosAdicional()->detach($request->documento[$i]);
                        $solicitud->documentosSubsanacion()->detach($request->documento[$i]);
                        $solicitud->documentosSubsanacion()->attach($request->documento[$i]);
                        break;
                    case 'admision':
                        $solicitud->documentosSubsanacion()->detach($request->documento[$i]);
                        $solicitud->documentosAdicional()->detach($request->documento[$i]);
                        break;
                }
            }
        }
        return redirect()->route('solicitud.revisar', $solicitud->id);
    }
}
