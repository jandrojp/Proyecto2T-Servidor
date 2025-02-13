<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    use HasFactory;

    protected $table = 'lineaspedidos'; 

    protected $fillable = [
        'pedido_id', 
        'producto_id', 
        'cantidad', 
        'precio', 
        'total', 
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Product::class);
    }
}
