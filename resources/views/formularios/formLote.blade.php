@extends('layouts.principal')
@include('layouts.navigation')

<!--Formulario para Registrar un Lote 
Agregar rutas para DB-->
<form action="{{ route('registro.lote.store') }} " method="POST">
    @csrf
    <div class="container-md text-center mt-4">
            <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Registrar Lote</h1>

            <section class="shadow-lg p-3 mb-5 bg-body-tertiary rounded mt-4">
                <div class="container-md text-center">
                    <div class="container-md text-center mt-4 ">
                        <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold; margin: 20px 0;">Datos</h1>
                    </div>

                    <div class="contaniner-lg row align-items-start">
                        <div class="col">
                            <div class="col form-floating mb-3">
                                <input type="text"
                                    name = "nombreLote" 
                                    class="form-control" 
                                    id="nombreLote"
                                    style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)">
                                <label for="nombreLote">Nombre del lote</label>
                            </div>
                        </div>
                        <!--Espacio para agregar area, agregar controlador para agregar nombres a BD-->
                        <div class="col">
                            <div class="col form-floating mb-3">
                                <input type="text" name="area" class="form-control" id="areaLote" 
                                    title="Ingresa el área en medidas de manzanas (número decimal)" 
                                    style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)">
                                <label for="areaLote">Area (manzanas)</label>
                                <div class="invalid-feedback">Por favor, ingresa el área en medidas de manzanas.</div>
                            </div>
                        </div>

                    </div>   
                    <!--Boton de Guardar lote-->
                    <div style="text-align: center;" class="mt-4">
                        <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Registrar Lote</button>
                    </div>  
                </div>
            </section>
            
    </div>
</form>