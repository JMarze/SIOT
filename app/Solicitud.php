<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = "solicitudes";

    protected $fillable = ['nombre_solicitante', 'tipo_limite', 'documentos_solicitante', 'documentos_tecnicos'];

    protected $dates = ['created_at'];

    // Relationships
    public function municipios(){
        return $this->belongsToMany('App\Municipio', 'solicitud_municipio', 'solicitud_id', 'municipio_codigo');
    }
}
