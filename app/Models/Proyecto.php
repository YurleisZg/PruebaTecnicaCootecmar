<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = ['nombre'];
    public function bloques() { return $this->hasMany(Bloque::class); }
    public function piezas() { return $this->hasMany(Pieza::class); }
}
