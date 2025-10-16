<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';       // Nombre exacto de la tabla
    protected $primaryKey = 'IDPROYECTO';// Clave primaria
    public $incrementing = false;        // No es auto-incremental
    protected $keyType = 'string';       // Es tipo string
    public $timestamps = false;          // Si no tienes created_at/updated_at

    protected $fillable = ['IDPROYECTO', 'NAME'];

    // Relación: un proyecto tiene muchos bloques
    public function bloques()
    {
        return $this->hasMany(Bloque::class, 'proyecto', 'IDPROYECTO');
        // 'proyecto' es FK en bloque, 'IDPROYECTO' es PK en proyecto
    }
}
