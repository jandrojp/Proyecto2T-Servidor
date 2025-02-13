@extends('layouts.template')

@section('title', 'Carrito de Compras')

@section('content')
@include('components.navClient')


<div class="container mt-5">
    @if($carrito && count($carrito) > 0)
        <table class="table table-bordered shadow">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center bg-primary text-white">Producto</th>
                    <th class="text-center bg-primary text-white">Precio</th>
                    <th class="text-center bg-primary text-white">Cantidad</th>
                    <th class="text-center bg-primary text-white">Total</th>
                    <th class="text-center bg-primary text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $item)
                    <tr class="text-center bg-light">
                        <td>
                            <img src="{{ Storage::url($item['image']) }}" alt="Imagen del producto" class="rounded" style="width: 130px; height: auto;">
                        </td>
                        <td class="align-middle mt-4">{{ $item['nombre'] }}</td>
                        <td class="align-middle mt-4">{{ number_format($item['precio'], 2) }} €</td>
                        <td class="align-middle mt-4">
                            <form action="{{ route('carrito.update', ['id' => $item['id']]) }}" method="POST" class="d-flex align-items-center justify-content-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="form-control cantidad-input" style="width: 70px;">
                                <button type="submit" class="btn btn-warning text-white btn-sm mt-2 ms-2 fw-bold">Actualizar</button>
                            </form>
                        </td>
                        <td class="align-middle mt-4">
                            {{ number_format($item['cantidad'] * $item['precio'], 2) }} €
                        </td>
                        <td class="align-middle mt-4">
                            <form action="{{ route('carrito.destroy', ['id' => $item['id_product']]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm fw-bold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('client.index') }}" class="btn btn-primary btn-lg fw-bold mt-5">
                Seguir Comprando
            </a>

            <form action="{{ route('carrito.confirmar') }}" method="POST">
            @csrf
                <button type="submit" class="btn btn-success btn-lg fw-bold mt-5">Confirmar Pedido</button>
            </form>

        </div>
    @else
        <p class="text-center text-muted mb-5">Tu carrito está vacío.</p>
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ route('client.index') }}" class="btn btn-primary btn-lg fw-bold mt-5">
                Seguir Comprando
            </a>
        </div>
    @endif
</div>

@endsection
