<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admision extends Model
{
    protected $table = "admisiones";

    protected $fillable = ['nota', 'etapa_inicio_codigo'];

    protected $dates = ['created_at'];

    // Relationships
    public function etapa_inicio(){
        return $this->belongsTo('App\EtapaInicio');
    }
}
