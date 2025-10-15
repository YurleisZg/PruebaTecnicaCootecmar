<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    public function usuario()
    {
    return $this->belongsTo(User::class, 'registrado_por');
    }

    protected $fillable = ['nombre_pieza','peso_teorico','peso_real','estado','proyecto_id','bloque_id'];
    public function proyecto() { return $this->belongsTo(Proyecto::class); }
    public function bloque() { return $this->belongsTo(Bloque::class); }

}
