<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';
    public $timestamps = false;

    protected $fillable = [
        'id_user', 
        'id_product', 
        'nombre', 
        'precio', 
        'cantidad',
    ];

}
