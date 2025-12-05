<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donacion extends Model
{
    use HasFactory;

    protected $table = 'donaciones';

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'proyecto_id',
        'user_id',
        'monto',
        'estado',
        'referencia',
        'mensaje',
    ];

    /**
     * Los atributos que se deben convertir.
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'monto' => 'decimal:2',
        ];
    }

    /**
     * Relación con el proyecto
     */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Relación con el donante
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
