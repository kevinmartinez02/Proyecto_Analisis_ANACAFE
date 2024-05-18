@extends('layouts.principal')
@include('layouts.navigation')

    <div class="container mt-5">
            <h1 class="mb-4">Lista de Usuarios</h1>

            <!-- Formulario de Búsqueda -->
            <form method="POST" action="{{ route('buscar.empleado') }} " class="mb-4">
                @csrf
                <div class="input-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre o email" value="{{ old('search', $search ?? '') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
    </div>