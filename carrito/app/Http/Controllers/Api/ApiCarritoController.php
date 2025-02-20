<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrito;


class ApiCarritoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $id_user = $request->id_user;
        $carrito = Carrito::where('id_user', $id_user)->get();
        return response()->json($carrito);
    
    }

    public function store(Request $request)
    {
        
        $carrito = new Carrito();
        $carrito->id_user = $request->idUsuario;
        $carrito->id_product = $request->idProducto;
        $carrito->nombre = $request->nombre;
        $carrito->precio = $request->precio;
        $carrito->cantidad = $request->cantidad;

        $carrito->save();
        return response()->json($carrito);    
    }

    public function destroy(Request $request)
    {
        $carrito = Carrito::where('id_user', $request->idUsuario)->where('id_product', $request->idProducto)->first();
        $carrito->delete(); 
        return response()->json(['success' => 'Producto eliminado del carrito'], 200);
    }

    public function update(Request $request)
    {
        $carrito = Carrito::where('id_user', $request->idUsuario)->where('id_product', $request->idProducto)->first();
        $carrito->cantidad = $request->cantidad;
        $carrito->save();

        return response()->json($carrito);
    }


}