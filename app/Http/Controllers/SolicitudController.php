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
        $solicitudes = Solicitud::orderBy('created_at', 'des')->paginate(12);
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
            flash()->success('Su solicitud fué enviada...');
        }catch(\Exception $ex){
            flash()->error('Su solicitud no fué enviada. Ocurrió un problema en la transacción...' . $ex->getMessage());
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

    public function uploadTecnico(Request $request, $id){
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
