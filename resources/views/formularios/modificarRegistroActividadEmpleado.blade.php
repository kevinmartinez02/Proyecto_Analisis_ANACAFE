@extends('layouts.principal')
@include('layouts.navigation')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($errors->has('nombreSubactividad'))
    <div class="alert alert-danger">
        <strong>¡Error!</strong> Debes ingresar al menos una subactividad.
    </div>
@endif


<form method="POST" action="{{route('edit.registro.empleado', ['id' => $registro->id])}}">
    @csrf
    @method('PUT')
    <div class="container-md text-center mt-4">
        <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Modificar Datos Actividad Empleados</h1>

        <section class="shadow-lg p-3 mb-5 bg-body-tertiary rounded mt-4">
            <div class="container-md text-center">
                <div class="container-md text-center mt-4">
                    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold; margin: 20px 0;">Datos personales</h1>
                </div>

                <div class="mb-4">
                    <label for="nombre" class="form-label font-weight-bold">Nombre:</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $registro->empleado->nombre }}</p>
                </div>

                <div class="mb-4">
                    <label for="fecha" class="form-label font-weight-bold">Fecha Actual:</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $registro->fecha }}</p>
                </div>

                <div class="form-floating mt-4">
                    <label for="fecha" class="form-label"></label>
                    <input type="date" name="fecha" min="2020-01-01" max="2026-12-31" class="form-control mb-3" id="fecha">
                </div>

                <div class="mb-4">
                    <label for="lote" class="form-label font-weight-bold">Lote Actual:</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light" id="lote">{{ $registro->lote->nombreLote }}</p>
                </div>

                <!--Select para Lote -->
                <select name="lote_id" class="form-select form-select-lg mb-3" aria-label="Large select example">
                    <option selected>Seleccione Nuevo Lote</option>
                    @foreach($lotes as $lote)
                        <option value="{{$lote->id}}">{{$lote->nombreLote}}</option>
                    @endforeach
                </select>

                <div class="mb-4">
                    <label for="actividad" class="form-label font-weight-bold">Actividad Actual:</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $registro->actividad->nombreActividad }}</p>
                </div>

                <!-- Select para Actividad -->
                <select id="actividad" name="actividad_id" class="form-select form-select-lg mb-3" aria-label="Large select example">
                    <option selected>Seleccione Actividad</option>
                    @foreach($actividades as $actividad)
                        <option value="{{$actividad->id}}">{{$actividad->nombreActividad}}</option>
                    @endforeach
                </select>

                <div class="mb-4">
                    <label for="subActividad" class="form-label font-weight-bold">SubActividad Actual:</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $registro->subActividad->nombreActividad }}</p>
                </div>

                <select id="sub-actividad" name="sub_actividad_id" class="form-select form-select-lg mb-3" aria-label="Large select example">
                    <option selected>Seleccione Sub-Actividad</option>
                </select>

                <div class="mb-4">
                    <label for="rendimiento" class="form-label font-weight-bold">Rendimiento Actual:</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $registro->rendimiento->tipo_rendimiento }}</p>
                </div>

                <!-- Select para tipo Rendimiento -->
                <select name="tipo_rendimiento" class="form-select form-select-lg mb-3" aria-label="Large select example">
                    <option selected>Seleccione tipo de Rendimiento</option>
                    @foreach($rendimiento as $rendimientos)
                        <option value="{{$rendimientos->id}}">{{$rendimientos->tipo_rendimiento}}</option>
                    @endforeach
                </select>

                <div class="mb-4">
                    <label for="observaciones" class="form-label font-weight-bold">Observaciones:</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light" id="observaciones">{{ $registro->observaciones }}</p>
                </div>

                <!-- Observaciones -->
                <div class="form-floating mt-4">
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                    <label for="observaciones">Observaciones</label>
                </div>

                <!-- Botón para enviar información de Registro -->
                <div style="text-align: center;" class="mt-4">
                    <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Actualizar</button>
                </div>
            </div>
        </section>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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
                    $("#sub-actividad").append('<option value="' + value.id + '">' + value.nombreActividad + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>