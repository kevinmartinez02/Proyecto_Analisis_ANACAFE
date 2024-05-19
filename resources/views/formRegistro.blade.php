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

<!--Formulario para Registrar un Empleado
Agregar rutas para DB-->
<Form method="POST" action="{{ route('registro.datos') }}" >
    @csrf
    <div class="container-md text-center mt-4">
        <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Registrar Empleados</h1>

        <section class="shadow-lg p-3 mb-5 bg-body-tertiary rounded mt-4">
            <div class="container-md text-center">
                <div class="container-md text-center mt-4 ">
                    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold; margin: 20px 0;">Datos personales</h1>
                </div>

                <div class="contaniner-lg row align-items-start">
                    <div class="col">
                        <div class="col form-floating mb-3">
                            <input type="name" name="nombre"class="form-control" id="nombre">
                            <label for="floatingInput">Nombre</label>
                        </div>
                    </div>
                    <!--Espacio para agregar nombre y apellido, agregar controlador para agregar nombres a BD-->
                    <div class="col">
                        <div class="col form-floating mb-3">
                            <input type="name" name ="apellido"class="form-control" id="apellido">
                            <label for="floatingInput">Apellido</label>
                        </div>
                    </div>
                </div>   
            
                <!--Declaracion para ingresar DPI-->
                <div class="form-floating mt-4">
                    <input type="text" name="dpi" class="form-control" id="dpi" pattern="\d{13}" title="Debe tener exactamente 13 números">
                    <label for="floatingPassword">Documento Personal de Identificación (DPI)</label>
                    <div class="invalid-feedback">El DPI debe tener exactamente 13 números.</div>
                </div>

                <!--Declaracion para ingresar IGGS-->
                <div class="form-floating mt-4">
                    <input type="text" name="numeroIGSS" class="form-control" id="numeroIGSS" pattern="\d{13}" title="Debe tener exactamente 13 digitos">
                    <label for="floatingPassword">No. de IGGS</label>
                    <div class="invalid-feedback">El IGGS debe tener exactamente 13 digitos.</div>
                </div>
                <!--Declaracion para ingresar NIT-->
                <div class="form-floating mt-4">
                    <input type="text" name="nit" class="form-control" id="numeroNIT" pattern="\d{9}" title="Debe tener exactamente 13 digitos" >
                    <label for="floatingPassword">NIT</label>
                    <div class="invalid-feedback">El NIT debe tener exactamente 9 digitos.</div>
                </div>
                <!--Titulo-->
                <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold;" class="mt-4">Contacto</h1>
                <!--Declaracion para ingresar Direccion-->
                <div class="form-floating mt-4">
                    <input type="text" name="direccion" class="form-control" id="direccion">
                    <label for="floatingPassword">Dirección</label>
                </div>
                <!--Declaracion para ingresar Telefono-->
                <div class="form-floating mt-4">
                    <input class="form-control" type="tel" name="numeroTelefono" id="telefono" pattern="(?:\+?(?:502)?[\s-]?)?[1-9]\d{3}[\s-]?\d{4}" title="Por favor, introduce un número de teléfono válido de Guatemala">
                    <label for="telefono">No. Teléfono</label>
                    <div class="invalid-feedback">Por favor, introduce un número de teléfono válido de Guatemala.</div>
                </div>
                <!--Boton de Guardar empleado-->
                <div style="text-align: center;" class="mt-4">
                    <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Registrar Empleado</button>
                </div>
            </div>
        </section>
    </div>
</Form>
