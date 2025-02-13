@extends('layouts.template')
@section('title', 'Product Details')

@section('content')
@include('components.navClient')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-6 p-5">
                        <div class="card-body">
                            <h1 class="card-title">{{ $product->name }}</h1>
                            <p class="card-text mt-5 fs-4">{{ $product->price }} €</p>
                            <p class="card-text">{{ $product->description }}</p>
                            <div class="mt-4">
                                <form action="{{ route('carrito.store') }}" method="POST">
                                @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input type="hidden" name="product_price" value="{{ $product->price }}">
    
                                    <label for="quantity-label" class="form-label fw-bold">Cantidad a comprar:</label>
                                    <input type="number" name="quantity" class="form-control" value="1" min="1" required>

                                    @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary mt-5 fw-bold w-50 fs-5">Comprar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



