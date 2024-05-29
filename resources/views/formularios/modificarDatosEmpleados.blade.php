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

<!--Formulario para Registrar un Empleado-->
<form method="POST" action="{{ route('update.empleado',['id' => $empleado->id] ) }}">
    @csrf
    @method('PUT')
    <div class="container-md text-center mt-4">
        <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Modificar Datos Empleados</h1>

        <section class="shadow-lg p-3 mb-5 bg-body-tertiary rounded mt-4">
            <div class="container-md text-center">
                <div class="container-md text-center mt-4">
                    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold; margin: 20px 0;">Datos personales</h1>
                </div>

                <div class="container-lg row align-items-start">
                    <div class="col">
                        <div class="col form-floating mb-3">
                            <input type="text" name="nombre" class="form-control" id="nombre" value="{{$empleado->nombre}}">
                            <label for="floatingInput">Nombre</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="col form-floating mb-3">
                            <input type="text" name="apellido" class="form-control" id="apellido" value="{{$empleado->apellido}}">
                            <label for="floatingInput">Apellido</label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mt-4">
                    <input type="text" name="dpi" class="form-control" id="dpi" pattern="\d{13}" title="Debe tener exactamente 13 números" value="{{$empleado->dpi}}">
                    <label for="floatingPassword">Documento Personal de Identificación (DPI)</label>
                    <div class="invalid-feedback">El DPI debe tener exactamente 13 números.</div>
                </div>

                <div class="form-floating mt-4">
                    <input type="text" name="numeroIGSS" class="form-control" id="numeroIGSS" pattern="\d{13}" title="Debe tener exactamente 13 dígitos" value="{{$empleado->numeroIGSS}}">
                    <label for="floatingPassword">No. de IGGS</label>
                    <div class="invalid-feedback">El IGGS debe tener exactamente 13 dígitos.</div>
                </div>

                <div class="form-floating mt-4">
                    <input type="text" name="nit" class="form-control" id="numeroNIT" pattern="\d{9}" title="Debe tener exactamente 9 dígitos" value="{{$empleado->nit}}">
                    <label for="floatingPassword">NIT</label>
                    <div class="invalid-feedback">El NIT debe tener exactamente 9 dígitos.</div>
                </div>

                <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold;" class="mt-4">Contacto</h1>

                <div class="form-floating mt-4">
                    <input type="text" name="direccion" class="form-control" id="direccion" value="{{$empleado->direccion}}">
                    <label for="floatingPassword">Dirección</label>
                </div>

                <div class="form-floating mt-4">
                    <input class="form-control" type="tel" name="numeroTelefono" id="telefono" pattern="(?:\+?(?:502)?[\s-]?)?[1-9]\d{3}[\s-]?\d{4}" title="Por favor, introduce un número de teléfono válido de Guatemala" value="{{$empleado->numeroTelefono}}">
                    <label for="telefono">No. Teléfono</label>
                    <div class="invalid-feedback">Por favor, introduce un número de teléfono válido de Guatemala.</div>
                </div>

                <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold;" class="mt-4">Tipo empleado</h1>
                
                
                    
                <label>Tipo de Empleado Actual: </label> {{ $tipo_empleado_asociado->tipo_empleado }} <br>
                         
                
                <select name="tipo_empleado" class="form-select form-select-lg mt-4" aria-label="Large select example" >
                <option selected>Seleccionar tipo de empleado</option>
                    @foreach($tipos_empleados as $tipos)
                    <option value="{{$tipos->id}}" >{{ $tipos->tipo_empleado}}</option>
                    @endforeach
                </select>
                

                <div style="text-align: center;" class="mt-4">
                    <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Actualizar Empleado</button>
                </div>
            </div>
        </section>
    </div>
</form>
