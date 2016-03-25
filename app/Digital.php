<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Digital extends Model
{
    protected $table = "digitales";
    public $timestamps = false;

    protected $fillable = ['a_utm', 'a_datum', 'a_zona', 'b_utm', 'b_datum', 'b_zona', 'c_utm', 'c_datum', 'c_zona', 'etapa_inicio_codigo'];

    // Relationships
    public function etapa_inicio(){
        return $this->belongsTo('App\EtapaInicio');
    }
}
