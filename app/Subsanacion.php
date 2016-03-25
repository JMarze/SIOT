<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsanacion extends Model
{
    protected $table = "subsanaciones";

    protected $fillable = ['nota', 'documentos', 'etapa_inicio_codigo'];

    protected $dates = ['created_at'];

    // Relationships
    public function etapa_inicio(){
        return $this->belongsTo('App\EtapaInicio');
    }
}
