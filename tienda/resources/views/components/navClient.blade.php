<?php
use App\Models\Carrito;

$userId = auth()->id();
$carrito = Carrito::where('id_user', $userId)->get(); 
?>

<div class="bg-primary container border d-flex justify-content-around align-items-center fw-bold mt-3 p-4 shadow rounded">
    <img class="img-fluid" src="{{ Storage::url('logo.png') }}" alt="" style="width: 60px; height: auto;">
    
    <a class="text-white text-decoration-none" href="{{ route('client.index') }}">
        <span class="material-symbols-outlined fs-3">home</span>
    </a>

    <a class="text-white text-decoration-none d-flex align-items-center" href="{{ route('client.carrito') }}">
        <span class="material-symbols-outlined fs-3">shopping_cart</span>
        <p class="m-0 ms-2 fs-4">{{ $carrito->count() }}</p>
    </a>
    
    <a class="text-white text-decoration-none" href="{{ route('login') }}">
        <span class="material-symbols-outlined fs-3">logout</span>
    </a>
</div>

