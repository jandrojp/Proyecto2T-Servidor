<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\LineaPedido;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PedidoController extends Controller
{

    const API_TOKEN = 'LQniaa0LzQVbVdukKsPIRqnuV7Afa3Y03X1fovRv3Z4znoyTWHB0VfJMHr4O';
    
    public function show($id)
    {
        $pedido = Pedido::with('lineas')->findOrFail($id);
        return view('client.pedido-show', compact('pedido'));
    }
    

    public function confirmarPedido(Request $request)
    {

        $apiToken = self::API_TOKEN;
        $id_user = auth()->user()->id;
    
        $carritoResponse = Http::withToken($apiToken)->get('http://carrito/api/carrito', [
            'id_user' => $id_user,
        ]);

        $carrito = $carritoResponse->json();

        $usuario = Auth::user();

        $pedido = new Pedido();
        $pedido->usuario_id = $usuario->id;
        $pedido->email = $usuario->email; 
        $pedido->total = 0; 
        $pedido->fecha = Carbon::now(); 
        $pedido->estado = "En proceso";
        $pedido->save();

        $totalPedido = 0;
        foreach ($carrito as $item) {
            $lineaPedido = new LineaPedido();
            $lineaPedido->pedido_id = $pedido->id;
            $lineaPedido->producto_id = $item['id_product']; 
            $lineaPedido->cantidad = $item['cantidad'];
            $lineaPedido->precio_unitario = $item['precio'];
            $lineaPedido->total = $item['cantidad'] * $item['precio'];
            $lineaPedido->save();

            $totalPedido += $lineaPedido->total;
        }

        $pedido->total = $totalPedido;
        $pedido->save();

  
        foreach ($carrito as $producto) {

            Http::withToken($apiToken)->delete('http://carrito/api/carrito', [
                'idUsuario' => $id_user,  
                'idProducto' => $producto['id_product'], 
            ]);
        }

        return redirect()->route('client.pedido', ['id' => $pedido->id])->with('success', 'Pedido confirmado con éxito.');
    }
}