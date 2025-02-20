<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model; 

class Usuario extends Model
{

    use HasFactory;
    
    protected $table = 'usuarios';  // Asegúrate de que esta línea esté presente
    protected $fillable = ['login', 'password', 'api_token'];
}