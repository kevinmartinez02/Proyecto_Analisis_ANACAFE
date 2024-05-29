@extends('layouts.principal')
@include('layouts.navigation')
<div class="container text-center">
    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Listado de Actividades</h1>

    <!-- Búsqueda -->
    <form action="{{ route('mostrar.lotes') }}" method="GET" class="mb-3" id="form-filtrar">
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
     <!-- Tabla de Lotes -->
     <table class="table">
        <thead>
            <tr>
    
                <th>Nombre Lote</th>
                <th>Area (en Manzanas)</th>
                <th>Modificar Datos</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($lotes as $lote)
            <tr>
                <td>{{ $lote->nombreLote }}</td>
                <td>{{ $lote->area}}</td>
                <td>
                <a href="{{ route('modificar.lotes', $lote->id) }}" class="btn btn-warning">Modificar</a></td>
                <td>
                    <!-- Botón para eliminar la actividad -->
                    <td>
                    <!-- Botón para eliminar la actividad -->
                    <form action="{{ route('eliminar.lote', $lote->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este Lote?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>