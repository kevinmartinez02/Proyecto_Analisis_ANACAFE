@extends('layouts.principal')
@include('layouts.navigation')

<form action="">
    <div class="container text-center mt-5">
        <label for="">Registrar actividades Fijo</label>
        <div class="col-md-6 offset-md-3">
            <!-- Búsqueda -->
            <form action="{{ route('mostrar.empleados') }}" method="GET" class="mb-3" id="form-filtrar">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" id="buscar-empleado" class="form-control" placeholder="Buscar empleado" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="button" id="btn-buscar" class="btn btn-primary w-100">Buscar</button>
                    </div>
                </div>
            </form>
            <!-- Select para mostrar resultados -->
            <select id="resultado-empleados" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione un empleado</option>
            </select>

            <!-- Ingresar fecha -->
            <label for="party" class="form-label">Ingrese fecha de registro:</label>
            <input type="date" name="party" min="2020-01-01" max="2026-12-31" class="form-control mb-3">


            <!-- Mensaje flotante -->
            <div class="mb-3" id="mensaje-flotante">
                <!-- Mensaje flotante para mostrar si se encontró el empleado -->    
            </div>

             <!--Select para Lote -->
            <select class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione el Lote</option>
                <option value="1">One</option>
            </select>
             <!-- Select para Actividad-->
            <select class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione Actividad</option>
                <option value="1">One</option>
            </select>
             <!-- Select para Sub-Actividad -->
            <select class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione Sub-Actividad</option>
                <option value="1">One</option>
            </select>
             <!-- Select para tipo Rendimiento -->
            <select class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione tipo de Rendimiento</option>
                <option value="1">One</option>
            </select>

            <!-- Observaciones -->
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <input class="form-control" id="observaciones" name="observaciones" rows="3"></input>
            </div>

            <!-- Botón para enviar información de Registro -->
            <div style="text-align: center; " class="mt-4">
                <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Registrar</button>
            </div>
        </div>
    </div>
</form>

<!-- Script para manejar la búsqueda de empleados y actualizar el select -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn-buscar').addEventListener('click', function() {
            const searchTerm = document.getElementById('buscar-empleado').value;
            // Realizar una solicitud AJAX para buscar empleados
            // Reemplaza 'URL_DE_BUSQUEDA' con la ruta a tu controlador o endpoint de búsqueda
            fetch(`URL_DE_BUSQUEDA?search=${searchTerm}`)
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById('resultado-empleados');
                    select.innerHTML = ''; // Limpiar opciones anteriores
                    if (data.length > 0) {
                        data.forEach(empleado => {
                            const option = document.createElement('option');
                            option.value = empleado.id;
                            option.textContent = `${empleado.nombre} ${empleado.apellido}`;
                            select.appendChild(option);
                        });
                        // Mostrar mensaje flotante si se encontraron resultados
                        document.getElementById('mensaje-flotante').innerHTML = `<p>Se encontraron ${data.length} empleados.</p>`;
                    } else {
                        // Mostrar mensaje flotante si no se encontraron resultados
                        document.getElementById('mensaje-flotante').innerHTML = '<p>No se encontraron empleados.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
