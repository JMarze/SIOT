<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pronunciamiento extends Model
{
    protected $table = "pronunciamientos";

    protected $fillable = ['colindante_id', 'pronunciamiento', 'documentos_observaciones', 'compromiso_pago', 'estado'];

    protected $dates = ['created_at', 'updated_at'];

    // Relationships
    public function colindante(){
        return $this->hasOne('App\Colindante');
    }
}
