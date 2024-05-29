@extends('layouts.principal')
@include('layouts.navigation')


<div class="container text-center">
    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Listado de Registros</h1>

    <!-- Búsqueda -->
    <form action="{{ route('mostrar.actividades.empleado') }}" method="GET" class="mb-3" id="form-filtrar">
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
     // Función para enviar una solicitud AJAX para filtrar registros por fechas
function filtrarRegistrosPorFechas() {
    // Obtener los valores de fecha de inicio y fecha final
    var startDate = document.getElementById('start-date').value;
    var endDate = document.getElementById('end-date').value;
    
    // Enviar una solicitud AJAX para obtener registros filtrados por el rango de fechas
    axios.get('{{ route("mostrar.actividades.empleado") }}', {
        params: {
            'start-date': startDate,
            'end-date': endDate
        }
    })
    .then(function(response) {
        // Actualizar la tabla con los registros filtrados
        document.querySelector('.table tbody').innerHTML = response.data;
    })
    .catch(function(error) {
        // Manejar errores
        console.error('Error:', error);
    });
}

// Escuchar el cambio en los campos de fecha para filtrar automáticamente los registros
document.getElementById('start-date').addEventListener('change', filtrarRegistrosPorFechas);
document.getElementById('end-date').addEventListener('change', filtrarRegistrosPorFechas);

// Función para limpiar los campos de fecha y mostrar todos los registros
function mostrarTodosLosRegistros() {
    // Limpiar los campos de fecha
    document.getElementById('start-date').value = '';
    document.getElementById('end-date').value = '';
    // Enviar el formulario para mostrar todos los registros
    document.getElementById('form-filtrar').submit();
}

// Escuchar el clic en el botón "Mostrar todos" para mostrar todos los registros
document.getElementById('mostrar-todos').addEventListener('click', mostrarTodosLosRegistros);



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
                <th>Fecha</th>
                <th>Nombre empleado</th>
                <th>Lote</th>
                <th>Actividad</th>
                <th>Sub-actividad</th>
                <th>Rendimiento</th>
                <th>Observaciones</th>
                <th>Modificar</th>
            </tr>
        </thead>
        <tbody>
           
            
                @foreach($registros as $registro)
                <tr>
                <td>{{$registro->fecha}}</td>
                <td>{{$registro->empleado->nombre}}</td>
                <td>{{$registro->lote->nombreLote}}</td>
                <td>{{$registro->actividad->nombreActividad}}</td>
                <td>{{$registro->subActividad->nombreActividad}}</td>
                <td>{{$registro->rendimiento->tipo_rendimiento}}</td>
                <td>{{$registro->observaciones}}</td>
                <td>
                <a href="{{ route('mostrar.edit.registro.empleado', $registro->id) }}" class="btn btn-warning">Modificar</a></td>
                <td>
                </tr>
              @endforeach
            
          
        </tbody>
    </table>
</div>
