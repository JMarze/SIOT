<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colindante extends Model
{
    protected $table="colindantes";
    public $timestamps =false;

    protected $fillable=['etapa_inicio_codigo', 'municipio_codigo', 'nota'.'fecha_emision_nota'];

    // Relationships
    public function etapa_inicio(){
        return $this->belongsTo('App\EtapaInicio');
    }

    public function pronunciamiento(){
        return $this->belongsTo('App\Pronunciamiento');
    }s
}
