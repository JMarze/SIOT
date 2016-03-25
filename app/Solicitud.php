<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use SoftDeletes;

    protected $table = "solicitudes";

    protected $fillable = ['nombre_solicitante', 'tipo_limite', 'documentos_solicitante', 'documentos_tecnicos', 'documentos_subsanacion', 'estado', 'mensaje', 'municipio_codigo'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    public function municipio(){
        return $this->belongsTo('App\Municipio');
    }
}
