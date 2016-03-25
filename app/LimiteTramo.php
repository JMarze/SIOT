<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LimiteTramo extends Model
{
    protected $table="limite_tramo";
    public $timestamps =false;

    protected $fillable=['etapa_inicio_codigo', 'distancia', 'vertices', 'municipios'];

    // Relationships
    public function etapa_inicio(){
        return $this->belongsTo('App\EtapaInicio');
    }
}
