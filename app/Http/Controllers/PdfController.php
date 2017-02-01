<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\EtapaInicio;

class PdfController extends Controller
{
    /**
     * Reporte de Registro de Delimitación
     *
     * @return \Illuminate\Http\Response
     */
    public function registro($codigoEtapaInicio){
        $etapaInicio = EtapaInicio::find($codigoEtapaInicio);

        $view = \View::make('pdf.registro', compact('etapaInicio'))->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream($codigoEtapaInicio . '.pdf');
    }
}
