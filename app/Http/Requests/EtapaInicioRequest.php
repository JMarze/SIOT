<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EtapaInicioRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $codigoEtapaInicio = $this->route('etapa_inicio');
        return [
            'informe_tecnico_legal' => 'required',
            'estado' => 'required',
            'nota' => 'required_unless:estado,adicional',
            'solicitud_id' => 'required|unique:etapa_inicio,solicitud_id,'.$codigoEtapaInicio.',codigo',
        ];
    }
}
