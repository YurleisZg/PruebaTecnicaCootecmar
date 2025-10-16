<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    use HasFactory;

    protected $table = 'bloques';
    protected $primaryKey = 'IDBLOQUE';
    public $incrementing = false; // No es autoincremental
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = ['IDBLOQUE', 'nombre', 'proyecto_id'];

    // Relación con Proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'IDPROYECTO');
    }

    // Relación con Piezas
    public function piezas()
    {
        return $this->hasMany(Pieza::class, 'bloque_id', 'IDBLOQUE');
    }
}
