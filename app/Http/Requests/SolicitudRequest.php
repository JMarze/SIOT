<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SolicitudRequest extends Request
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
        return [
            'nombre_solicitante' => 'required|max:100',
            'tipo_limite' => 'required',
            'municipios' => 'required',
        ];
    }
}
