@extends('layouts.template')

@section('content')
@include('components.navAdmin')
<div class="container mt-5 p-5">
    <div class="row">
        <div class="col-md-12">
            @if(isset($users) && count($users) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="bg-primary text-white text-center" scope="col">Nombre</th>
                                <th class="bg-primary text-white text-center" scope="col">Email</th>
                                <th class="bg-primary text-white text-center" scope="col">Password</th>
                                <th class="bg-primary text-white text-center" scope="col">Rol</th>
                                <th class="bg-primary text-white text-center" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->password }}</td>
                                    <td class="text-center">{{ $user->role }}</td>
                                    <td>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">
                    No hay usuarios disponibles.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
