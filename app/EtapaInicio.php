<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EtapaInicio extends Model
{
    use SoftDeletes;

    protected $table = "etapa_inicio";

    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'informe_tecnico_legal', 'informe_pronunciamiento', 'acta_cierre', 'estado', 'fecha_estado', 'solicitud_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'fecha_estado'];

    // Mutators
    public function setInformeTecnicoLegalAttribute($file_informe){
        $fileName = $this->attributes['solicitud_id'] . "-InformeTecLegal" . "." . $file_informe->getClientOriginalExtension();
        $this->attributes['informe_tecnico_legal'] = $fileName;
        \Storage::disk('local')->put($fileName, \File::get($file_informe));
    }

    // Relationships
    public function solicitud(){
        return $this->hasOne('App\Solicitud', 'id', 'solicitud_id');
    }
}
