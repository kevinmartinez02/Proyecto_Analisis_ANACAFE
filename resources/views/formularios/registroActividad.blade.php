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

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection

<form method="POST" action="{{ route('registro.actividad.empleado.store') }}">
    @csrf
    <div class="container-md text-center mt-4">
        <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Registrar Actividades Personal</h1>

        <section class="shadow-lg p-3 mb-5 bg-body-tertiary rounded mt-4">
            <div class="container-md text-center">
                <div class="container-md text-center mt-4">
                    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold; margin: 20px 0;">Datos de la Actividad</h1>
                </div>

                <div class="container-lg row align-items-start">
                    <div class="col-md-6 offset-md-3">
                        <!-- Select para Tipo de Empleado -->
                        <div class="form-floating mb-3">
                            <select id="tipo-empleado" class="form-select form-select-lg mb-3" aria-label="Large select example" style="font-size: 18px;">
                                <option selected>Seleccione tipo de empleado</option>
                                @foreach($tipoEmpleados as $tipoEmpleado)
                                    <option value="{{ $tipoEmpleado->id }}">{{ $tipoEmpleado->tipo_empleado }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select para Empleado -->
                        <div class="form-floating mb-3">
                            <select name="empleado_id" id="empleado" class="form-select form-select-lg mb-3" aria-label="Large select example" style="font-size: 18px;">
                                <option selected>Seleccione un empleado</option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" name="fecha" min="2020-01-01" max="2026-12-31" class="form-control" id="fecha" style="font-size: 18px;">
                            <label for="fecha">Ingrese fecha de inicio</label>
                        </div>

                        <div class="form-floating mb-3" id="mensaje-flotante">
                            <!-- Mensaje flotante para mostrar si se encontró el empleado -->
                        </div>

                        <div class="form-floating mb-3">
                            <select name="lote_id" class="form-select form-select-lg mb-3" aria-label="Large select example" style="font-size: 18px;">
                                <option selected>Seleccione el Lote</option>
                                @foreach($lotes as $lote)
                                    <option value="{{ $lote->id }}">{{ $lote->nombreLote }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <select id="actividad" name="actividad_id" class="form-select form-select-lg mb-3" aria-label="Large select example" style="font-size: 18px;">
                                <option selected>Seleccione Actividad</option>
                                @foreach($actividades as $actividad)
                                    <option value="{{ $actividad->id }}">{{ $actividad->nombreActividad }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <select id="sub-actividad" name="sub_actividad_id" class="form-select form-select-lg mb-3" aria-label="Large select example" style="font-size: 18px;">
                                <option selected>Seleccione Sub-Actividad</option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <select name="tipo_rendimiento" class="form-select form-select-lg mb-3" aria-label="Large select example" style="font-size: 18px;">
                                <option selected>Seleccione tipo de Rendimiento</option>
                                @foreach($rendimiento as $rendimientos)
                                    <option value="{{ $rendimientos->id }}">{{ $rendimientos->tipo_rendimiento }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="observaciones" name="observaciones" style="font-size: 18px;" placeholder="Escriba sus observaciones aquí" rows="3"></textarea>
                            <label for="observaciones">Observaciones</label>
                        </div>

                        <div style="text-align: center;" class="mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Cambio en el select de tipo de empleado
        $('#tipo-empleado').on('change', function() {
            var tipoEmpleadoId = this.value;
            $("#empleado").html('');
            $.ajax({
                url: "{{ route('fetch.empleados') }}",
                type: "POST",
                data: {
                    tipo_empleado_id: tipoEmpleadoId,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#empleado').html('<option value="">Seleccione un empleado</option>');
                    $.each(res, function (key, value) {
                        $("#empleado").append('<option value="' + value.id + '">' + value.text + '</option>');
                    });
                }
            });
        });

        // Inicialización de select2 para empleado con búsqueda
        $('#empleado').select2({
            placeholder: 'Seleccione un empleado',
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('fetch.empleados') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        tipo_empleado_id: $('#tipo-empleado').val(),
                        _token: '{{csrf_token()}}'
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        // Cambio en el select de actividad
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
                }
            });
        });
    });
</script>