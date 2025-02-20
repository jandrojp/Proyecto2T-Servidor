<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Carrito;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use App\Models\Pedido;
use App\Models\LineaPedido;

class CarritoController extends Controller
{
    const API_TOKEN = 'LQniaa0LzQVbVdukKsPIRqnuV7Afa3Y03X1fovRv3Z4znoyTWHB0VfJMHr4O';


    public function index(Request $request)
    {
        $apiToken = self::API_TOKEN;

        $id_user = auth()->user()->id;

        $response = Http::withToken($apiToken)->get('http://carrito/api/carrito', [
            'id_user' => $id_user,
        ]);

        if ($response->successful()) {
            $carrito = $response->json();

            foreach ($carrito as &$item) {
                $producto = Product::find($item['id_product']);
                $item['image'] = $producto ? $producto->image : null; 
            }

            return view('client.carrito', compact('carrito'));
        }

        return response()->json(['error' => 'No se pudo cargar el carrito'], 400);
    }


    public function store(Request $request)
    {
        $apiToken = self::API_TOKEN;

        $id_user = auth()->user()->id;
        $product = Product::find($request->input('product_id'));

        $response = Http::withToken($apiToken)->post('http://carrito/api/carrito', [
            'idUsuario' => $id_user, 
            'idProducto' => $request->input('product_id'), 
            'nombre' => $product->name,
            'precio'=> $product->price,
            'cantidad' => $request->input('quantity'), 
        ]);

        if ($response->successful()) {
            return redirect()->route('client.carrito')->with('success', 'Producto añadido al carrito');
        }

        return back()->withErrors(['error' => 'No se pudo agregar el producto al carrito']);
    }



    public function destroy(Request $request, $productId)
    {
        $apiToken = self::API_TOKEN; 
        $id_user = auth()->user()->id;

        $response = Http::withToken($apiToken)->delete('http://carrito/api/carrito', [
            'idUsuario' => $id_user,  
            'idProducto' => $productId, 
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Producto eliminado del carrito');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el producto del carrito');
        }
    }




    public function update(Request $request, $id)
    {
        $apiToken = self::API_TOKEN; 
        $id_user = auth()->user()->id;

        $response = Http::withToken($apiToken)->put("http://carrito/api/carrito", [
            'idUsuario' => $id_user,  
            'idProducto' => $id,
            'cantidad' => $request->input('cantidad')
        ]);


        if ($response->successful()) {
            return redirect()->route('client.carrito')->with('success', 'Producto actualizado en el carrito');
        }

        return redirect()->route('client.carrito')->withErrors('Error al actualizar el producto');
    }

}
