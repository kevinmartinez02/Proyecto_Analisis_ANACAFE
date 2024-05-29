@extends('layouts.principal')
@include('layouts.navigation')

<div class="container text-center">
    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Listado de Actividades</h1>

    <!-- Búsqueda -->
    <form action="{{ route('mostrar.actividades') }}" method="GET" class="mb-3" id="form-filtrar">
        <div class="date-container">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por actividad" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="mostrar-todos">Mostrar todos</button>
                </div>
            </div>
        </div>    
    </form>

    <script>
    document.getElementById('mostrar-todos').addEventListener('click', function() {
        // Limpiar el valor del campo de búsqueda antes de enviar el formulario
        document.getElementById('form-filtrar').querySelector('input[name="search"]').value = '';
        // Enviar el formulario
        document.getElementById('form-filtrar').submit();
    });
    </script>

    <!-- Tabla de Actividades -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Actividad</th>
                <th>Subactividades</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actividades as $actividad)
            <tr>
                <td>{{ $actividad->id }}</td>
                <td>{{ $actividad->nombreActividad }}</td>
                <td>
                    <ul>
                        @foreach ($actividad->subActividades as $subActividad)
                        <li>{{ $subActividad->nombreActividad }} - {{ $subActividad->descripcion }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('mostrar.actividad.modificar', $actividad->id) }}" class="btn btn-warning">Modificar</a>
                </td>
                <td>
                    <!-- Botón para eliminar la actividad -->
                    <form action="{{ route('eliminar.actividad', $actividad->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta actividad?');">
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