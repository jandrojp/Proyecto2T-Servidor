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
    public function index()
    {
        $apiToken = auth()->user()->api_token;
        $response = Http::withToken($apiToken)->get('http://carrito/api/carrito');

        if ($response->successful()) {
            $carrito = $response->json(); 

            foreach ($carrito as &$item) {
                $producto = Product::find($item['id_product']);
                $item['image'] = $producto->image; 
            }

            return view('client.carrito', compact('carrito'));
        }

        return back()->withErrors('No se pudo cargar el carrito');
    }

    
    public function store(Request $request)
    {
        $apiToken = auth()->user()->api_token;
        $user = User::where('api_token', $apiToken)->first();

        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ], [
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número.',
            'quantity.min' => 'La cantidad debe ser al menos 1.',
        ]);

        $product = Product::find($request->input('product_id'));

        $existingItem = Carrito::where('id_user', $user->id)
                            ->where('id_product', $request->input('product_id'))
                            ->first();

        if ($existingItem) {
            $existingItem->cantidad += $request->input('quantity');
            $existingItem->save();

        } else {

            Carrito::create([
                'id_user' => $user->id,
                'id_product' => $request->input('product_id'),
                'nombre' => $product->name,
                'precio' => $product->price,
                'cantidad' => $request->input('quantity'), 
            ]);
        }

        return redirect()->route('client.carrito')->with('success', 'Producto añadido al carrito');
    }


    public function destroy(Request $request, $id)
    {
        $apiToken = auth()->user()->api_token;
        $response = Http::withToken($apiToken)->delete("http://carrito/api/carrito/{$id}");

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Producto eliminado del carrito');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el producto del carrito');
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $apiToken = auth()->user()->api_token;
        $response = Http::withToken($apiToken)->put("http://carrito/api/carrito/{$id}", [
            'cantidad' => $request->input('cantidad')
        ]);

        if ($response->successful()) {
            return redirect()->route('client.carrito')->with('success', 'Producto actualizado en el carrito');
        }

        return redirect()->route('client.carrito')->withErrors('Error al actualizar el producto');
    }

}
