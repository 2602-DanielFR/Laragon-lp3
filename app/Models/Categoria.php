<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'color',
    ];

    /**
     * Relación: Una categoría tiene muchos proyectos
     */
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
}
