@extends('layouts.principal')
@include('layouts.navigation')

<div class="container">
    <h1>Lista de Empleados</h1>

    <!-- Búsqueda -->
    <form action="{{ route('mostrar.empleados') }}" method="GET" class="mb-3" id="form-filtrar">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o apellido" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary" id="mostrar-todos">Mostrar todos</button>
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

    <!-- Tabla de Empleados -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>No. DPI</th>
                <th>No. IGGS</th>
                <th>No. NIT</th>
                <th>Direccion</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->apellido }}</td>
                <td>{{ $empleado->dpi }}</td>
                <td>{{ $empleado->numeroIGSS }}</td>
                <td>{{ $empleado->nit }}</td>
                <td>{{ $empleado->direccion }}</td>
                <td>{{ $empleado->numeroTelefono}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
