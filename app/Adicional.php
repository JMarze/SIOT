<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    protected $table = "adicionales";

    protected $fillable = ['documentos', 'etapa_inicio_codigo'];

    protected $dates = ['created_at'];

    // Relationships
    public function etapa_inicio(){
        return $this->belongsTo('App\EtapaInicio');
    }
}
