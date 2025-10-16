<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'registro';
    protected $primaryKey = 'IDPIEZA'; // si es único por registro, sino puedes usar un id auto
    public $timestamps = false;        // manejamos FECHA_REGISTRO manualmente

    protected $fillable = [
        'IDPIEZA',
        'PIEZA',
        'PESO_TEORICO',
        'PESO_REAL',
        'ESTADO',
        'IDBLOQUE',
        'FECHA_REGISTRO',
        'REGISTRADO_POR'
    ];

    // Relación con Pieza
    public function pieza()
    {
        return $this->belongsTo(Pieza::class, 'IDPIEZA', 'IDPIEZA');
    }

    // Relación con Bloque
    public function bloque()
    {
        return $this->belongsTo(Bloque::class, 'IDBLOQUE', 'idbloque');
    }
}
