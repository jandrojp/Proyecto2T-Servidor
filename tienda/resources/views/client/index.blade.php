@extends('layouts.template')
@section('title', 'Product List')

@section('content')
@include('components.navClient')
<div class="container mt-5">
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <img src="{{ Storage::url($product->image) }}" class="h-50">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->price }} €</p>
                        <a href="{{ route('client.show', $product) }}" class="btn btn-primary fw-bold">Ver detalles</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">No hay productos.</div>
        @endforelse
    </div>
</div>


@endsection
