<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    // Status Constants
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pendiente_revision';
    const STATUS_ACTIVE = 'activo';
    const STATUS_COMPLETED = 'completado';
    const STATUS_CANCELLED = 'cancelado';
    const STATUS_REJECTED = 'rechazado';

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'user_id',
        'categoria_id',
        'titulo',
        'descripcion',
        'descripcion_corta',
        'objetivo_recaudacion',
        'monto_actual',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'imagen',
        'imagen_banner',
        'contador_donantes',
        'contador_donaciones',
        'porcentaje_alcanzado',
        'razon_rechazo',
    ];

    /**
     * Los atributos que se deben convertir.
     */
    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'datetime',
            'fecha_fin' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'objetivo_recaudacion' => 'decimal:2',
            'monto_actual' => 'decimal:2',
            'porcentaje_alcanzado' => 'decimal:2',
        ];
    }

    /**
     * Relación con el usuario (emprendedor que crea el proyecto)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con la categoría
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relación con las actualizaciones del proyecto
     */
    public function actualizaciones(): HasMany
    {
        return $this->hasMany(ActualizacionProyecto::class, 'proyecto_id');
    }

    /**
     * Relación con las donaciones
     */
    public function donaciones(): HasMany
    {
        return $this->hasMany(Donacion::class, 'proyecto_id');
    }

    /**
     * Calcula el porcentaje alcanzado
     */
    public function calcularPorcentaje(): float
    {
        if ($this->objetivo_recaudacion == 0) {
            return 0;
        }
        return min(100, ($this->monto_actual / $this->objetivo_recaudacion) * 100);
    }

    /**
     * Obtiene el estado en formato legible
     */
    public function getEstadoLegible(): string
    {
        return match ($this->estado) {
            self::STATUS_DRAFT => 'Borrador',
            self::STATUS_PENDING => 'Pendiente de Revisión',
            self::STATUS_ACTIVE => 'Activo',
            self::STATUS_COMPLETED => 'Completado',
            self::STATUS_CANCELLED => 'Cancelado',
            self::STATUS_REJECTED => 'Rechazado',
            default => $this->estado,
        };
    }

    /**
     * Obtiene el badge de estado (para Bootstrap/Tailwind)
     */
    public function getEstadoBadge(): string
    {
        return match ($this->estado) {
            self::STATUS_DRAFT => 'bg-gray-500',
            self::STATUS_PENDING => 'bg-yellow-500',
            self::STATUS_ACTIVE => 'bg-green-500',
            self::STATUS_COMPLETED => 'bg-blue-500',
            self::STATUS_CANCELLED => 'bg-red-500',
            self::STATUS_REJECTED => 'bg-red-600',
            default => 'bg-gray-500',
        };
    }

    /**
     * Verifica si el proyecto está activo para recibir donaciones
     */
    public function puedeRecibirDonaciones(): bool
    {
        return $this->estado === self::STATUS_ACTIVE && 
               $this->fecha_inicio <= now() && 
               $this->fecha_fin > now();
    }

    /**
     * Verifica si se alcanzó la meta
     */
    public function metaAlcanzada(): bool
    {
        return $this->monto_actual >= $this->objetivo_recaudacion;
    }

    /**
     * Obtiene los días restantes para el proyecto
     */
    public function diasRestantes(): int
    {
        if ($this->fecha_fin === null) {
            return 0;
        }
        return now()->diffInDays($this->fecha_fin, false);
    }

    /**
     * Obtiene el monto faltante para alcanzar la meta
     */
    public function montoFaltante(): float
    {
        $faltante = $this->objetivo_recaudacion - $this->monto_actual;
        return max(0, $faltante);
    }

    /**
     * Accessor para la URL de la imagen principal
     */
    public function getImagenUrlAttribute()
    {
        return $this->imagen ? asset('storage/' . $this->imagen) : null;
    }

    /**
     * Accessor para la URL del banner
     */
    public function getImagenBannerUrlAttribute()
    {
        return $this->imagen_banner ? asset('storage/' . $this->imagen_banner) : null;
    }
}
