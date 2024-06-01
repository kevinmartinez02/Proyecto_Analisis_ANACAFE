@extends('layouts.principal')
@include('layouts.navigation')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        document.getElementById('form-filtrar').querySelector('input[name="search"]').value = '';
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
            <tr id="actividad-{{ $actividad->id }}">
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
                        <button type="button" class="btn btn-danger action-btn eliminar-actividad" data-actividad-id="{{ $actividad->id }}" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <div class="px-6 py-3">
            {{ $actividades->links() }}
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
axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.eliminar-actividad').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const actividadId = this.dataset.actividadId;

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
                    axios.delete(`{{ url('actividad/eliminar') }}/${actividadId}`)
                    .then(function(response) {
                        if (response.status === 200) {
                            Swal.fire(
                                '¡Eliminado!',
                                response.data.message,
                                'success'
                            );
                            // Eliminar la fila de la tabla
                            document.getElementById('actividad-' + actividadId).remove();
                        } else {
                            throw new Error('Error en la respuesta del servidor');
                        }
                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Error',
                            'Hubo un problema al eliminar la actividad.',
                            'error'
                        );
                    });
                }
            });
        });
    });
});
</script>
