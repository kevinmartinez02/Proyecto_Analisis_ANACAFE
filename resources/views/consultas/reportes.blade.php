@extends('layouts.principal')
@include('layouts.navigation')


<div class="container text-center">
    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Listado de Registros</h1>

    <!-- Búsqueda -->
    <form action="{{ route('mostrar.empleados') }}" method="GET" class="mb-3" id="form-filtrar">
        <div class="date-container">
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
        
            <div class="row">
                <div class="col-md-2">
                    <label for="start-date">Fecha Inicio:</label>
                    <input type="date" id="start-date" name="start-date">
                </div>
                <div class="col-md-2">
                    <label for="end-date">Fecha Final:</label>
                    <input type="date" id="end-date" name="end-date">
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

    <!-- Tabla de Empleados -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Nombre empleado</th>
                <th>Lote</th>
                <th>Actividad</th>
                <th>Sub-actividad</th>
                <th>Rendimiento</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
           
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
          
        </tbody>
    </table>
</div>
