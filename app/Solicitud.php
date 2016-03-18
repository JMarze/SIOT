<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = "solicitudes";

    protected $fillable = ['nombre_solicitante', 'tipo_limite', 'documentos_solicitante', 'documentos_tecnicos', 'documentos_subsanacion', 'estado', 'mensaje', 'municipio_codigo'];

    // Relationships
    public function municipio(){
        return $this->belongsTo('App\Municipio');
    }
}
