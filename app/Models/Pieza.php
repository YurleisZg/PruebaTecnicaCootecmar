<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    use HasFactory;

    protected $table = 'pieza';          // Nombre exacto de la tabla
    protected $primaryKey = 'IDPIEZA';   // Clave primaria
    public $timestamps = false;          // Usamos FECHA_REGISTRO manual
    protected $fillable = [
        'PIEZA',
        'PESO_TEORICO',
        'PESO_REAL',
        'ESTADO',
        'PROYECTO',
        'BLOQUE',
        'FECHA_REGISTRO',
        'REGISTRADO_POR'
    ];

    // Relación con Bloque
    public function bloque()
    {
        return $this->belongsTo(Bloque::class, 'BLOQUE', 'name');
        // 'BLOQUE' en pieza es el nombre del bloque
        // 'name' en bloque es el nombre del bloque
    }

    // Relación con Proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'PROYECTO', 'IDPROYECTO');
        // 'PROYECTO' en pieza es el ID del proyecto
    }
}
