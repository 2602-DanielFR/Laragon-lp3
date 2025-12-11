<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donante extends Model
{
    use HasFactory;

    protected $table = 'donantes';

    protected $fillable = [
        'user_id',
        'descripcion_personal',
        'organizacion',
        'foto_perfil',
        'biografia_breve',
        'enlaces_redes',
    ];

    protected $casts = [
        'enlaces_redes' => 'array',
    ];

    /**
     * Relación con User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el nombre del usuario
     */
    public function getNombre()
    {
        return $this->user->name ?? 'Donante Anónimo';
    }

    /**
     * Obtener el email del usuario
     */
    public function getEmail()
    {
        return $this->user->email ?? null;
    }
}
