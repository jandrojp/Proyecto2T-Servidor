@extends('layouts.template')

@section('content')

<div class="bg-primary container d-flex align-items-center justify-content-center rounded mt-5 shadow-lg p-4">
    <p class="fw-bold fs-1 text-white m-0 text-center shadow-sm">Pisa fuerte, pisa con estilo.</p>
</div>


<div class="container d-flex flex-column align-items-center mt-5 w-25 p-5 border rounded shadow">
    <p class="mb-4 text-center fs-1 fw-bold">Iniciar Sesión</p>

    <form method="POST" action="{{ route('login') }}" class="w-100">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        @if ($errors->any())
        <div class="container mt-5 alert alert-danger">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <button class="btn btn-primary w-100 fw-bold" type="submit">Iniciar Sesión</button>
    </form>

    <img class="img-fluid mt-5" src="{{ Storage::url('logo.png') }}" alt="" style="width: 180px; height: auto;">
</div>


@endsection
