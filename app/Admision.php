<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admision extends Model
{
    protected $table = "admisiones";

    protected $fillable = ['nota', 'etapa_inicio_codigo'];

    protected $dates = ['created_at', 'updated_at'];

    // Mutators
    public function setNotaAttribute($file_informe){
        $fileName = $this->attributes['id'] . "-Nota_Admision" . "." . $file_informe->getClientOriginalExtension();
        $this->attributes['nota'] = $fileName;
        \Storage::disk('local')->put($fileName, \File::get($file_informe));
    }

    // Relationships
    public function etapa_inicio(){
        return $this->belongsTo('App\EtapaInicio');
    }
}
