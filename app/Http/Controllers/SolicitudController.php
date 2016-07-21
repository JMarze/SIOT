<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Http\Requests\SolicitudRequest;

use App\Solicitud;
use App\Municipio;

class SolicitudController extends Controller
{
    public function __construct(){
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
        $solicitud = new Solicitud($request->all());
        try{
            $solicitud->save();
            $solicitud->municipios()->attach($request->municipios);
            flash()->success('Su solicitud fué registrada...');
        }catch(\Exception $ex){
            flash()->error('Su solicitud no fué registrada. Ocurrió un problema en la transacción...' . $ex->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()){
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
        }
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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()){
            try{
                $solicitud = Solicitud::find($id);
                $solicitud->delete();

                if($solicitud->documentos_solicitante != null && \Storage::disk('local')->exists($solicitud->documentos_solicitante)){
                    \Storage::disk('local')->delete($solicitud->documentos_solicitante);
                }
                if($solicitud->documentos_tecnicos != null && \Storage::disk('local')->exists($solicitud->documentos_tecnicos)){
                    \Storage::disk('local')->delete($solicitud->documentos_tecnicos);
                }

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

    public function uploadSolicitud(Request $request, $id)
    {
        $this->validate($request, [
            'documentos_solicitante' => 'required|mimes:zip,rar',
        ]);
        if ($request->ajax()){
            try{
                $solicitud = Solicitud::find($id);
                $solicitud->documentos_solicitante = $request->documentos_solicitante;
                $solicitud->update();
                flash()->success('El archivo se subió exitosamente...');
                return response()->json([
                    'mensaje' => $solicitud->id,
                ]);
            }catch(\Exception $ex){
                flash()->error('Se presentó un problema al subir el archivo... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function uploadTecnico(Request $request, $id)
    {
        $this->validate($request, [
            'documentos_tecnicos' => 'required|mimes:zip,rar',
        ]);
        if ($request->ajax()){
            try{
                $solicitud = Solicitud::find($id);
                $solicitud->documentos_tecnicos = $request->documentos_tecnicos;
                $solicitud->update();
                flash()->success('El archivo se subió exitosamente...');
                return response()->json([
                    'mensaje' => $solicitud->id,
                ]);
            }catch(\Exception $ex){
                flash()->error('Se presentó un problema al subir el archivo... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
