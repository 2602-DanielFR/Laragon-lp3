<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'icono',
        'color',
    ];

    /**
     * Relación con los proyectos
     */
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class, 'categoria_id');
    }

    /**
     * Obtiene el número de proyectos activos en esta categoría
     */
    public function proyectosActivos()
    {
        return $this->proyectos()->where('estado', 'activo');
    }
}
