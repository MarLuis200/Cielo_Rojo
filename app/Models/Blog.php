<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'administrador_id',
        'nombre',
        'contenido',
        'estado',
    ];

    protected $casts = [
        'contenido' => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(Administrador::class, 'administrador_id');
    }
}
