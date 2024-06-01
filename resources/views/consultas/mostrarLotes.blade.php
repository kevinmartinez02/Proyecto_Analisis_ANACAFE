@extends('layouts.principal')
@include('layouts.navigation')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<div class="container text-center">
    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Listado de Lotes</h1>

    <!-- Búsqueda -->
    <form action="{{ route('mostrar.lotes') }}" method="GET" class="mb-3" id="form-filtrar">
        <div class="date-container">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por Lote" value="{{ request('search') }}">
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

    <!-- Tabla de Lotes -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Lote</th>
                <th>Area (en Manzanas)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lotes as $lote)
            <tr id="lote-{{ $lote->id }}">
                <td>{{ $lote->id }}</td>
                <td>{{ $lote->nombreLote }}</td>
                <td>{{ $lote->area }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('modificar.lotes', $lote->id) }}" class="btn btn-warning action-btn" title="Modificar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger action-btn eliminar-lote" data-lote-id="{{ $lote->id }}" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <div class="px-6 py-3">
            {{ $lotes->links() }}
        </div>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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
axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.eliminar-lote').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const loteId = this.dataset.loteId;

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
                    axios.delete('{{ url("lotes") }}/' + loteId + '/delete', {
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    })
                    .then(function(response) {
                        if (response.status === 200) {
                            Swal.fire(
                                '¡Eliminado!',
                                response.data.message,
                                'success'
                            );
                            // Eliminar la fila de la tabla
                            document.getElementById('lote-' + loteId).remove();
                        } else {
                            throw new Error('Error en la respuesta del servidor');
                        }
                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Error',
                            'Hubo un problema al eliminar el lote.',
                            'error'
                        );
                    });
                }
            });
        });
    });
});
</script>
