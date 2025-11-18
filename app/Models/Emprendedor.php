<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprendedor extends Model
{
    use HasFactory;

    protected $table = 'emprendedores';


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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
