<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprendedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'descripcion_personal',
        'organizacion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}