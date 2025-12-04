<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActualizacionProyecto extends Model
{
    use HasFactory;

    protected $table = 'actualizaciones_proyecto';

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'proyecto_id',
        'titulo',
        'contenido',
        'imagen',
    ];

    /**
     * Los atributos que se deben convertir.
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación con el proyecto
     */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
