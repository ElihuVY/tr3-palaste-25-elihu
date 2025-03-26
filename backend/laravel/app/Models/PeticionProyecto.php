<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeticionProyecto extends Model
{
    protected $table = 'peticiones_proyectos';
    
    protected $fillable = [
        'user_id', 'descripcion', 
        'detalle_mejorado', 'estado'
    ];

    protected $casts = [
        'estado' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function archivos()
    {
        return $this->hasMany(ArchivoProyecto::class, 'peticion_id');
    }
}
