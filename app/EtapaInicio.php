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

    protected $fillable = ['codigo', 'informe_tecnico_legal', 'informe_pronunciamiento', 'acta_cierre', 'estado', 'fecha_estado'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    public function colindantes(){
        return $this->hasMany('App\Colindante');
    }

    public function adicional(){
        return $this->hasOne('App\Adicional');

    }
}
