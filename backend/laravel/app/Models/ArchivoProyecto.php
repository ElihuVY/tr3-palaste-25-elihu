<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivoProyecto extends Model
{
    protected $table = 'archivos_proyectos';
    
    protected $fillable = [
        'peticion_id', 'tipo', 'archivo_url'
    ];

    protected $casts = [
        'tipo' => 'string'
    ];

    public function peticion()
    {
        return $this->belongsTo(PeticionProyecto::class, 'peticion_id');
    }
}
