<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = "provincias";
    public $timestamps = false;

    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'nombre', 'departamento_codigo'];

    // Relationships
    public function municipios(){
        return $this->hasMany('App\Municipio');
    }

    public function departamento(){
        return $this->belongsTo('App\Departamento');
    }
}
