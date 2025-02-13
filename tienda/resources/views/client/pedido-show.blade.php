@extends('layouts.template')

@section('title', 'Detalle del Pedido')

@section('content')
<div class="container mt-5">

    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detalles del Pedido</h4>
        </div>
        <div class="card-body">
            <p><strong>Email del comprador:</strong> {{ $pedido->email }}</p>
            <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
            <p><strong>Dirección:</strong> c/Reino de Valencia 46192</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Productos del Pedido</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedido->lineas as $linea)
                        <tr>
                            <td>{{ $linea->producto->name }}</td>
                            <td>{{ $linea->cantidad }}</td>
                            <td>{{ number_format($linea->precio_unitario, 2) }} €</td>
                            <td>{{ number_format($linea->total, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Total -->
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('client.index') }}" class="btn btn-primary">Seguir Comprando</a>
        <h3>Total: {{ number_format($pedido->total, 2) }} €</h3>
    </div>
</div>
@endsection

