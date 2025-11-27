<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reconocimiento extends Model
{
    use HasFactory;

    protected $table = 'reconocimientos';

    protected $fillable = [
        'administrador_id',
        'titulo',
        'contenido',
        'estado'
    ];

    protected $casts = [
        'contenido' => 'array',
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }

    // Scope para reconocimientos publicados
    public function scopePublicados($query)
    {
        return $query->where('estado', 'publicado');
    }
}
