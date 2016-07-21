<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Solicitud extends Model
{
    protected $table = "solicitudes";

    protected $fillable = ['nombre_solicitante', 'tipo_limite', 'documentos_solicitante', 'documentos_tecnicos'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    public function municipios(){
        return $this->belongsToMany('App\Municipio', 'solicitud_municipio', 'solicitud_id', 'municipio_codigo');
    }
    public function etapa_inicio(){
        return $this->hasOne('App\EtapaInicio');
    }

    // Mutators
    public function setDocumentosSolicitanteAttribute($file_solicitante){
        $fileName = $this->attributes['id'] . "-DS" . Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . "_" . Carbon::now()->hour . Carbon::now()->minute . Carbon::now()->second . "." . $file_solicitante->getClientOriginalExtension();
        $this->attributes['documentos_solicitante'] = $fileName;
        \Storage::disk('local')->put($fileName, \File::get($file_solicitante));
    }
    public function setDocumentosTecnicosAttribute($file_tecnicos){
        $fileName = $this->attributes['id'] . "-DT" . Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . "_" . Carbon::now()->hour . Carbon::now()->minute . Carbon::now()->second . "." . $file_tecnicos->getClientOriginalExtension();
        $this->attributes['documentos_tecnicos'] = $fileName;
        \Storage::disk('local')->put($fileName, \File::get($file_tecnicos));
    }
}
