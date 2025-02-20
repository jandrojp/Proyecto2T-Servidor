<?php

use Illuminate\Support\Facades\Http;

$apiToken = 'LQniaa0LzQVbVdukKsPIRqnuV7Afa3Y03X1fovRv3Z4znoyTWHB0VfJMHr4O';

        $id_user = auth()->user()->id;

        $response = Http::withToken($apiToken)->get('http://carrito/api/carrito', [
            'id_user' => $id_user,
        ]);

        $carrito = $response->json();

?>


<div class="bg-primary container border d-flex justify-content-around align-items-center fw-bold mt-3 p-4 shadow rounded">
    <img class="img-fluid" src="{{ Storage::url('logo.png') }}" alt="" style="width: 60px; height: auto;">
    
    <a class="text-white text-decoration-none" href="{{ route('client.index') }}">
        <span class="material-symbols-outlined fs-3">home</span>
    </a>

    <a class="text-white text-decoration-none d-flex align-items-center" href="{{ route('client.carrito') }}">
        <span class="material-symbols-outlined fs-3">shopping_cart</span>
        <p class="m-0 ms-2 fs-4"><?php echo count($carrito) ?></p>
    </a>
    
    <a class="text-white text-decoration-none" href="{{ route('login') }}">
        <span class="material-symbols-outlined fs-3">logout</span>
    </a>
</div>

