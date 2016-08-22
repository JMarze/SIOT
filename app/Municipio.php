<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = "municipios";
    public $timestamps = false;

    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'nombre', 'capital', 'ley', 'fecha_ley', 'proceso_2150', 'provincia_codigo'];

    protected $dates = ['fecha_ley'];

    // Relationships
    public function provincia(){
        return $this->belongsTo('App\Provincia', 'provincia_codigo', 'codigo');
    }

    public function solicitudes(){
        return $this->belongsToMany('App\Solicitud', 'solicitud_municipio', 'municipio_codigo', 'solicitud_id');
    }
}
