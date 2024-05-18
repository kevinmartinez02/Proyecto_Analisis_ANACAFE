@extends('layouts.principal')
@include('layouts.navigation')

    <div class="container mt-5">
            <h1 class="mb-4">Lista de Usuarios</h1>

            <!-- Formulario de Búsqueda -->
            <form method="GET" action="" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o email" value="{{ old('search', $search ?? '') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>

            <!-- Lista de Usuarios -->
            <div class="row">
                @forelse($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"><strong>DPI:</strong> </p>
                            <p class="card-text"><strong>No. IGGS:</strong> </p>
                            <p class="card-text"><strong>No. NIT:</strong> </p>
                            <p class="card-text"><strong>Direccion:</strong> </p>
                            <p class="card-text"><strong>Telefono:</strong> </p>
                            <a href="{{ url('/users', $user->id) }}" class="btn btn-info">Ver</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        No se encontraron usuarios
                    </div>
                </div>
                @endforelse
            </div>
    </div>