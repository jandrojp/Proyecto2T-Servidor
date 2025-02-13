<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'user_id', 
        'total', 
        'direccion', 
        'estado', 
        'dni_cliente', 
    ];

    public function lineas()
    {
        return $this->hasMany(LineaPedido::class);
    }
}