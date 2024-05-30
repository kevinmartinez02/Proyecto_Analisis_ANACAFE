@extends('layouts.principal')
@include('layouts.navigation')
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
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
                <th>Acciones</th>
                
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
                    <div class="btn-group" role="group">
                        <a href="{{ route('mostrar.actividad.modificar', $actividad->id) }}" class="btn btn-warning action-btn" title="Modificar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('eliminar.actividad', $actividad->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger action-btn" onclick="return confirm('¿Estás seguro de que deseas eliminar esta actividad?');" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>
    .action-btn {
        width: 40px; /* Ajusta este valor según sea necesario */
        height: 40px; /* Ajusta este valor según sea necesario */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .action-btn i {
        font-size: 18px; /* Ajusta el tamaño del icono según sea necesario */
    }
</style>
