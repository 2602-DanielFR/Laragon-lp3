<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donante extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'direccion',
        'telefono',
        'foto_perfil',
        'biografia_breve',
        'enlaces_redes',
    ];

    protected $casts = [
        'enlaces_redes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
