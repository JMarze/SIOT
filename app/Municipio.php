<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = "municipios";
    public $timestamps = false;

    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'nombre', 'provincia_codigo'];

    // Relationships
    public function provincia(){
        return $this->belongsTo('App\Provincia');
    }

    public function solicitudes(){
        return $this->hasMany('App\Solicitud');
    }
}
