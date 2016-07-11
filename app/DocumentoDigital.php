<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoDigital extends Model
{
    protected $table = "documentos_digitales";

    protected $fillable = ['descripcion'];

    public $timestamps = false;

    // Relationships
    public function etapasInicio(){
        return $this->belongsToMany('App\EtapaInicio', 'etapa_inicio_documento_digital', 'documento_digital_id', 'etapa_inicio_codigo')->withPivot('cumple');
    }
}
