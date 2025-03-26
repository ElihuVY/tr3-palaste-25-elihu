<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    
    protected $fillable = ['user_id', 'total', 'estado'];

    protected $casts = [
        'estado' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_producto')
                    ->withPivot('cantidad', 'precio_unitario');
    }
}
