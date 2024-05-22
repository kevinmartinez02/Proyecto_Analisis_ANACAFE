<!-- resources/views/registro/actividad.blade.php -->

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
                @foreach($lotes as $lote)
                <option value="{{$lote->id}}">{{$lote->nombreLote}}</option>
                @endforeach
            </select>
            
            <!-- Select para Actividad-->
            <select id="actividad" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione Actividad</option>
                @foreach($actividades as $actividad)
                <option value="{{$actividad->id}}">{{$actividad->nombreActividad}}</option>
                @endforeach
            </select>

            <select id="sub-actividad" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione Sub-Actividad</option>
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
            <div style="text-align: center;" class="mt-4">
                <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Registrar</button>
            </div>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#actividad').on('change', function () {
            var actividadId = this.value;
            $("#sub-actividad").html('');
            $.ajax({
                url: "{{ route('fetch.subactividades') }}",
                type: "POST",
                data: {
                    actividad_id: actividadId,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#sub-actividad').html('<option value="">Seleccione Sub-Actividad</option>');
                    $.each(res, function (key, value) {
                        $("#sub-actividad").append('<option value="' + value.id_actividad + '">' + value.nombreActividad + '</option>');
                    });
                }
            });
        });
    });
</script>