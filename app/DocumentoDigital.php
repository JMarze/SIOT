<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoDigital extends Model
{
    protected $table = "documentos_digitales";

    protected $fillable = ['descripcion', 'articulo_inter', 'articulo_intra', 'texto_inter', 'texto_intra', 'opcional'];

    public $timestamps = false;

    // Relationships
    public function documentosSolicitud(){
        return $this->belongsToMany('App\Solicitud', 'documento_digital_solicitud', 'documento_digital_id', 'solicitud_id')->withPivot('cumple', 'fojas_de', 'fojas_a', 'archivo', 'estado', 'fecha', 'observaciones');
    }
    public function documentosAdicional(){
        return $this->belongsToMany('App\Solicitud', 'documento_digital_adicional', 'documento_digital_id', 'solicitud_id')->withPivot('cumple', 'archivo', 'estado', 'fecha', 'observaciones');
    }
    public function documentosSubsanacion(){
        return $this->belongsToMany('App\Solicitud', 'documento_digital_subsanacion', 'documento_digital_id', 'solicitud_id')->withPivot('cumple', 'archivo', 'estado', 'fecha', 'observaciones');
    }
}
