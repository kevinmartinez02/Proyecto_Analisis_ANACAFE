@extends('layouts.principal')
@include('layouts.navigation')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
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
        document.getElementById('form-filtrar').querySelector('input[name="search"]').value = '';
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
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr id="empleado-{{ $empleado->id }}">
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->apellido }}</td>
                <td>{{ $empleado->dpi }}</td>
                <td>{{ $empleado->numeroIGSS }}</td>
                <td>{{ $empleado->nit }}</td>
                <td>{{ $empleado->direccion }}</td>
                <td>{{ $empleado->numeroTelefono}}</td>
                <td>{{ $empleado->tipoEmpleado->tipo_empleado }}</td>
                <td class="estado-{{ $empleado->id }}">{{ $empleado->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <button type="button" class="btn btn-sm cambiar-estado {{ $empleado->estado ? 'btn-danger' : 'btn-success' }}" data-empleado-id="{{ $empleado->id }}">
                        {{ $empleado->estado ? 'Desactivar' : 'Activar' }}
                    </button>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('mostrar.empleado.modificar', $empleado->id) }}" class="btn btn-warning action-btn" title="Modificar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger action-btn eliminar-empleado" data-empleado-id="{{ $empleado->id }}" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <div class="px-6 py-3">
            {{ $empleados->links() }}
        </div>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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
    document.querySelectorAll('.eliminar-empleado').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const empleadoId = this.dataset.empleadoId;

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
                    axios.delete('{{ url("empleados") }}/' + empleadoId, {
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    })
                    .then(function(response) {
                        Swal.fire(
                            '¡Eliminado!',
                            'El empleado ha sido eliminado.',
                            'success'
                        );
                        // Eliminar la fila de la tabla
                        document.getElementById('empleado-' + empleadoId).remove();
                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Error',
                            'Hubo un problema al eliminar el empleado.',
                            'error'
                        );
                    });
                }
            });
        });
    });

</script>

