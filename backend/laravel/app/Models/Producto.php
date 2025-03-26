<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    
    protected $fillable = [
        'nombre', 'descripcion', 'imagen', 
        'precio', 'stock', 'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_producto')
                    ->withPivot('cantidad', 'precio_unitario');
    }
}
