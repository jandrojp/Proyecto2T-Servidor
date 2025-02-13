@extends('layouts.template')

@section('content')
@include('components.navAdmin')
<div class="container d-flex flex-column align-items-center mt-5 w-25 p-5 border rounded shadow">
    <p class="mb-4 text-center fw-bold fs-1">Alta Usuario</p>

    <form action="{{ route('users.store') }}" method="POST" class="w-100">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
            @error('name') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
            @error('email') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select name="role" id="role" class="form-control">
                <option value="admin">ADMIN</option>
                <option value="client">CLIENT</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary fw-bold w-100">Alta Usuario</button>
    </form>
</div>
@endsection
