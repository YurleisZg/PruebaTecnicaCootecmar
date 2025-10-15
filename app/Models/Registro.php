<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model {
    protected $fillable = ['pieza_id','proyecto_id','bloque_id','usuario_id','peso_real','diferencia'];
    public function usuario() { return $this->belongsTo(Usuario::class); }
}

