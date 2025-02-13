<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Carrito;
use Illuminate\Support\Facades\Log;

class ApiCarritoController extends Controller
{

    public function index(Request $request)
    {
        $apiToken = $request->bearerToken();
        $user = User::where('api_token', $apiToken)->first();

        $carrito = Carrito::where('id_user', $user->id)->get();
        return response()->json($carrito);
    }


    public function store(Request $request)
    {
        $apiToken = $request->bearerToken();
        $user = User::where('api_token', $apiToken)->first();

        $product = Producto::find($request->input('product_id'));

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

        return response()->json(['success' => 'Producto agregado al carrito']);
    }


    public function destroy($id)
    {
        $apiToken = request()->bearerToken();
        $user = User::where('api_token', $apiToken)->first();

        $item = Carrito::where('id_user', $user->id)
                    ->where('id_product', $id)
                    ->first();

        $item->delete();
        return response()->json(['success' => 'Producto eliminado del carrito'], 200);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $item = Carrito::where('id', $id)
                       ->where('id_user', auth()->id()) 
                       ->first();

        $item->cantidad = $request->input('cantidad');
        $item->save(); 

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'item' => $item
        ], 200);
    }


}