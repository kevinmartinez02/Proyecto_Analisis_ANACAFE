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
                        <option value="">Seleccione</option>
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
                        <option value="">Seleccione</option>
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
                <th>ID</th>
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
                <tr id="registro-{{ $registro->id }}">  
                    <td>{{$registro->id}}</td>
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
                            <button type="button" class="btn btn-danger action-btn eliminar-btn" data-id="{{ $registro->id }}" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <div class="px-6 py-3">
            {{$registros->links()}}
        </div>
    </table>
</div>

<style>
    .action-btn {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .action-btn i {
        font-size: 18px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

document.addEventListener('DOMContentLoaded', function() {
    // Assign the click event to the delete buttons
    document.querySelectorAll('.eliminar-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            eliminarRegistro(id);
        });
    });
});

function eliminarRegistro(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/reportes/${id}/delete`)
                .then(function(response) {
                    if (response.status === 200) {
                        Swal.fire(
                            '¡Eliminado!',
                            response.data.message,
                            'success'
                        );
                        // Remove the row from the table
                        document.getElementById(`registro-${id}`).remove();
                    } else {
                        throw new Error('Error en la respuesta del servidor');
                    }
                })
                .catch(function(error) {
                    Swal.fire(
                        'Error',
                        'Hubo un problema al eliminar el registro.',
                        'error'
                    );
                });
        }
    });
}

document.getElementById('mostrar-todos').addEventListener('click', function() {
    document.querySelector('input[name="search"]').value = '';
    document.getElementById('start-date').value = '';
    document.getElementById('end-date').value = '';
    document.getElementById('actividad').value = '';
    document.getElementById('lote').value = '';
    document.getElementById('rendimiento').value = '';

    document.getElementById('form-filtrar').submit();
});

// Function to send an AJAX request to filter records by dates
function filtrarRegistrosPorFechas() {
    var startDate = document.getElementById('start-date').value;
    var endDate = document.getElementById('end-date').value;

    axios.get('{{ route("mostrar.actividades.empleado") }}', {
        params: {
            'start-date': startDate,
            'end-date': endDate
        }
    })
    .then(function(response) {
        document.querySelector('.table tbody').innerHTML = response.data;
    })
    .catch(function(error) {
        console.error('Error:', error);
    });
}

document.getElementById('start-date').addEventListener('change', filtrarRegistrosPorFechas);
document.getElementById('end-date').addEventListener('change', filtrarRegistrosPorFechas);
</script>
