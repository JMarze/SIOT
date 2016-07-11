<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    protected $table = "codigos";

    protected $fillable = ['numero', 'año'];

    public $timestamps = false;
}
