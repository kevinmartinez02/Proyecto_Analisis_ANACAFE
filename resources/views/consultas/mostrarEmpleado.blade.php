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
                <th>Estado</th>
                <th>Acciones</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Escuchar el clic en el botón para cambiar el estado del empleado
    document.querySelectorAll('.cambiar-estado').forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Obtener el ID del empleado
            const empleadoId = this.dataset.empleadoId;
            const btn = this;

            // Enviar la solicitud AJAX al servidor
            axios.put('{{ route('update.estado.empleado') }}', {
                empleado_id: empleadoId,
                _token: '{{ csrf_token() }}' // Añadir CSRF token
            })
            .then(function(response) {
                // Actualizar el estado en la interfaz de usuario
                const estado = response.data.estado;
                const estadoText = estado === 'Activo' ? 'Desactivar' : 'Activar';
                btn.textContent = estadoText;
                btn.classList.toggle('btn-success', estado === 'Inactivo');
                btn.classList.toggle('btn-danger', estado === 'Activo');
                document.querySelector('.estado-' + empleadoId).textContent = estado;
                // Opcional: mostrar un mensaje de éxito
                toastr.success('Estado del empleado actualizado exitosamente.');
            })
            .catch(function(error) {
                // Manejar cualquier error
                console.error('Error:', error);
                // Opcional: mostrar un mensaje de error
                toastr.error('Error al actualizar el estado del empleado.');
            });
        });
    });
});
</script>

