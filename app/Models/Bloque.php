<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloque extends Model {
    protected $fillable = ['nombre_bloque','proyecto_id'];
    public function proyecto() { return $this->belongsTo(Proyecto::class); }
    public function piezas() { return $this->hasMany(Pieza::class); }
}

