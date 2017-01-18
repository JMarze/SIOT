<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Solicitud extends Model
{
    use SoftDeletes;

    protected $table = "solicitudes";

    protected $fillable = ['nombre_solicitante', 'tipo_limite', 'estado', 'informe_tecnico_legal', 'nota_admision', 'nota_subsanacion', 'user_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    public function municipios(){
        return $this->belongsToMany('App\Municipio', 'solicitud_municipio', 'solicitud_id', 'municipio_codigo');
    }
    public function documentosSolicitud(){
        return $this->belongsToMany('App\DocumentoDigital', 'documento_digital_solicitud', 'solicitud_id', 'documento_digital_id')->withPivot('cumple', 'fojas_de', 'fojas_a', 'archivo', 'estado', 'fecha', 'observaciones');
    }
    public function documentosAdicional(){
        return $this->belongsToMany('App\DocumentoDigital', 'documento_digital_adicional', 'solicitud_id', 'documento_digital_id')->withPivot('cumple', 'archivo', 'estado', 'fecha', 'observaciones');
    }
    public function documentosSubsanacion(){
        return $this->belongsToMany('App\DocumentoDigital', 'documento_digital_subsanacion', 'solicitud_id', 'documento_digital_id')->withPivot('cumple', 'archivo', 'estado', 'fecha', 'observaciones');
    }
    public function etapa_inicio(){
        return $this->hasOne('App\EtapaInicio');
    }

    // Mutators
    /*public function setDocumentosSolicitanteAttribute($file_solicitante){
        $fileName = $this->attributes['id'] . "-DS" . Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . "_" . Carbon::now()->hour . Carbon::now()->minute . Carbon::now()->second . "." . $file_solicitante->getClientOriginalExtension();
        $this->attributes['documentos_solicitante'] = $fileName;
        \Storage::disk('local')->put($fileName, \File::get($file_solicitante));
    }
    public function setDocumentosTecnicosAttribute($file_tecnicos){
        $fileName = $this->attributes['id'] . "-DT" . Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . "_" . Carbon::now()->hour . Carbon::now()->minute . Carbon::now()->second . "." . $file_tecnicos->getClientOriginalExtension();
        $this->attributes['documentos_tecnicos'] = $fileName;
        \Storage::disk('local')->put($fileName, \File::get($file_tecnicos));
    }*/
}
