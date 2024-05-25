@extends('layouts.principal')
@include('layouts.navigation')

<form method="POST" action="{{ route('registro.actividad.store')}}">
    @csrf
    <div class="container text-center mt-5">
        <label for="">Registrar actividades Eventual</label>
        <div class="col-md-6 offset-md-3">
            <!-- Campo de búsqueda de empleado -->
            
            <!-- Select para mostrar resultados -->
            <select  name="empleado_id" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione un empleado</option>
                @foreach($empleados as $empleado)
                <option value="{{$empleado->id}}" >{{$empleado->nombre}} {{$empleado->apellido}}</option>
    
                @endforeach
            </select>

            <!-- Ingresar fecha -->
            <label for="party" class="form-label">Ingrese fecha de registro:</label>
            <input type="date" name="fecha" min="2020-01-01" max="2026-12-31" class="form-control mb-3">

            <!-- Mensaje flotante -->
            <div class="mb-3" id="mensaje-flotante">
                <!-- Mensaje flotante para mostrar si se encontró el empleado -->
            </div>

            <!--Select para Lote -->
            <select name="lote_id" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione el Lote</option>
                @foreach($lotes as $lote)
                <option value="{{$lote->id}}">{{$lote->nombreLote}}</option>
                @endforeach
            </select>
            
            <!-- Select para Actividad-->
            <select id="actividad" name="actividad_id" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione Actividad</option>
                @foreach($actividades as $actividad)
                <option value="{{$actividad->id}}">{{$actividad->nombreActividad}}</option>
                @endforeach
            </select>

            <select id="sub-actividad" name="sub_actividad_id" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione Sub-Actividad</option>
            </select>
        
            <!-- Select para tipo Rendimiento -->
            <select name="tipo_rendimiento" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>Seleccione tipo de Rendimiento</option>
                @foreach($rendimiento as $rendimientos)
                <option value="{{$rendimientos->id}}">{{$rendimientos->tipo_rendimiento}}</option>
                @endforeach
                <!-- Agregar más opciones si es necesario -->
            </select>

            <!-- Observaciones -->
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
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
</script>