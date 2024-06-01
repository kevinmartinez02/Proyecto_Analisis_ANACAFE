@extends('layouts.principal')
@include('layouts.navigation')

<div class="container text-center">
    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Estado de empleado</h1>

    <!-- Búsqueda -->
    <form action="{{ route('mostrar.estados.empleados') }}" method="GET" class="mb-3" id="form-filtrar">
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
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->apellido }}</td>
                <td>
                    <button type="button" class="btn btn-sm cambiar-estado {{ $empleado->estado === 'Activo' ? 'btn-danger' : 'btn-success' }}" data-empleado-id="{{ $empleado->id }}">
                        {{ $empleado->estado }}
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
                const estado = response.data.estado;
                btn.textContent = estado;
                btn.classList.toggle('btn-success', estado === 'Inactivo');
                btn.classList.toggle('btn-danger', estado === 'Activo');
                toastr.success('Estado del empleado actualizado exitosamente.');
            })
            .catch(function(error) {
                console.error('Error:', error);
                toastr.error('Error al actualizar el estado del empleado.');
            });
        });
    });
});
</script>
