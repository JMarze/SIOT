<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = "departamentos";
    public $timestamps = false;

    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'nombre'];

    // Relationships
    public function provincias(){
        return $this->hasMany('App\Provincia');
    }
}
