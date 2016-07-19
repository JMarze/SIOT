<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsanacion extends Model
{
    protected $table = "subsanaciones";

    public $timestamps =false;

    protected $fillable = ['nota', 'documentos', 'etapa_inicio_codigo'];

    protected $dates = ['created_at'];

    // Mutators
    public function setNotaAttribute($file_informe){
        $fileName = $this->attributes['id'] . "-Nota_Subsanacion" . "." . $file_informe->getClientOriginalExtension();
        $this->attributes['nota'] = $fileName;
        \Storage::disk('local')->put($fileName, \File::get($file_informe));
    }

    // Relationships
    public function etapa_inicio(){
        return $this->belongsTo('App\EtapaInicio');
    }
}
