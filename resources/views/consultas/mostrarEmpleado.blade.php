@extends('layouts.principal')
@include('layouts.navigation')

<div class="container text-center">
    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Listado de empleados</h1>

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
                <th>Tipo Empleado</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Modificar Datos</th>
                <th>Eliminar</th> <!-- Añadir columna para eliminar -->
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
                <td>{{$empleado->tipoEmpleado->tipo_empleado}}</td>
                <td class="estado-{{ $empleado->id }}">{{ $empleado->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <!-- Botón para cambiar el estado -->
                    <button type="button" class="btn btn-sm cambiar-estado {{ $empleado->estado ? 'btn-danger' : 'btn-success' }}" data-empleado-id="{{ $empleado->id }}">
                        {{ $empleado->estado ? 'Desactivar' : 'Activar' }}
                    </button>
                </td>
                <td>
                    <a href="{{ route('mostrar.empleado.modificar', $empleado->id) }}" class="btn btn-warning">Modificar</a>
                </td>
                <td>
                    <!-- Botón para eliminar el empleado -->
                    <form action="{{ route('eliminar.empleado', $empleado->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cambiar-estado').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const empleadoId = this.dataset.empleadoId;
            const btn = this;

            axios.put('{{ route('update.estado.empleado') }}', {
                empleado_id: empleadoId,
                _token: '{{ csrf_token() }}'
            })
            .then(function(response) {
                // Recargar la página después de actualizar el estado
                window.location.reload();
            })
            .catch(function(error) {
                console.error('Error:', error);
                toastr.error('Error al actualizar el estado del empleado.');
            });
        });
    });
});
</script>

