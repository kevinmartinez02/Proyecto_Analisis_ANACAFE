@extends('layouts.principal')
@include('layouts.navigation')
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>


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

    <!-- Botón para el reporte PDF -->
    <div style="text-align: right; margin-bottom: 10px;">
        <a href="{{ route('reporte.pdf', ['start-date' => request('start-date'), 'end-date' => request('end-date')]) }}" class="btn btn-success" title="Generar Reporte PDF">
            <i class="fas fa-file-pdf"></i> Generar Reporte PDF
        </a>
    </div>

            <div class="row mt-3">
                <div class="col-md-2">
                    <label for="start-date">Fecha Inicio:</label>
                    <input type="date" id="start-date" name="start-date" value="{{ request('start-date') }}">
                </div>
                <div class="col-md-2">
                    <label for="end-date">Fecha Final:</label>
                    <input type="date" id="end-date" name="end-date" value="{{ request('end-date') }}">
                </div>
                <div class="col-md-2">
                    <label for="actividad">Actividad:</label>
                    <select id="actividad" name="actividad" class="form-control">
                        <option value="">Seleccione Actividad</option>
                        @foreach($actividades as $actividad)
                            <option value="{{ $actividad->nombreActividad }}" {{ request('actividad') == $actividad->nombreActividad ? 'selected' : '' }}>
                                {{ $actividad->nombreActividad }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="lote">Lote:</label>
                    <select id="lote" name="lote" class="form-control">
                        <option value="">Seleccione Lote</option>
                        @foreach($lotes as $lote)
                            <option value="{{ $lote->nombreLote }}" {{ request('lote') == $lote->nombreLote ? 'selected' : '' }}>
                                {{ $lote->nombreLote }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="rendimiento">Rendimiento:</label>
                    <select id="rendimiento" name="rendimiento" class="form-control">
                        <option value="">Seleccione Rendimiento</option>
                        @foreach($rendimientos as $rendimiento)
                            <option value="{{ $rendimiento->tipo_rendimiento }}" {{ request('rendimiento') == $rendimiento->tipo_rendimiento ? 'selected' : '' }}>
                                {{ $rendimiento->tipo_rendimiento }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>

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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
                <tr>
                    <td>{{ $registro->fecha }}</td>
                    <td>{{ $registro->empleado->nombre }}</td>
                    <td>{{ $registro->lote->nombreLote }}</td>
                    <td>{{ $registro->actividad->nombreActividad }}</td>
                    <td>{{ $registro->subActividad->nombreActividad }}</td>
                    <td>{{ $registro->rendimiento->tipo_rendimiento }}</td>
                    <td>{{ $registro->observaciones }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('mostrar.edit.registro.empleado', $registro->id) }}" class="btn btn-warning action-btn" title="Modificar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('eliminar.registro.empleado', $registro->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger action-btn" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');" title="Eliminar">
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
        // Limpiar los campos de búsqueda y filtros
        document.querySelector('input[name="search"]').value = '';
        document.getElementById('start-date').value = '';
        document.getElementById('end-date').value = '';
        document.getElementById('actividad').value = '';
        document.getElementById('lote').value = '';
        document.getElementById('rendimiento').value = '';

        // Enviar el formulario para mostrar todos los registros
        document.getElementById('form-filtrar').submit();
    }

    // Escuchar el clic en el botón "Mostrar todos" para mostrar todos los registros
    document.getElementById('mostrar-todos').addEventListener('click', mostrarTodosLosRegistros);
</script>
