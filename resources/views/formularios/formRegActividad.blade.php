@extends('layouts.principal')
@include('layouts.navigation')

<!--Formulario para Registrar un Lote 
Agregar rutas para DB-->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form id="form" action="{{ route('registro.actividad.store') }}" method="POST">


@csrf
    <div class="container-md text-center mt-4">
                <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">Registrar Actividad</h1>

                <section class="shadow-lg p-3 mb-5 bg-body-tertiary rounded mt-4">
                    <div class="container-md text-center">
                        <div class="container-md text-center mt-4 ">
                            <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold; margin: 20px 0;">Actividad</h1>
                        </div>

                        <div class="contaniner-lg row align-items-start">
                            <div class="col">
                                <!-- espacio para ingresar nombre de actividad -->
                                <div class="col form-floating mb-3">
                                    <input type="text"
                                        name="nombreActividad" 
                                        class="form-control" 
                                        id="nombre">
                                    <label for="floatingInput">Nombre de actividad</label>
                                </div>
                            </div>
                        </div>   
                        <!--Boton de Guardar lote-
                        <div style="text-align: center; " class="mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Registrar Actividad</button>
                        </div> -->
                    </div>

                    
                </section>
                
                <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <div class="container-md text-center mt-4 ">
                                <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold; margin: 20px 0;">Sub-Actividad</h1>
                    </div>
                    <!-- botton para agregar compo para sub-actividad -->
                    <div style="text-align: center;" class="mt-4">
                    
                        <button id="agregar" class="btn btn-primary" style="background-color: #00bfff; border: 2px solid #00bfff;">
                            Agregar Sub-actividad
                        </button>
                    </div> 
                    <div class="container" id="dinamic"> </div>
                    <!-- botton para enviar informacion de Actividad -->
                        <div style="text-align: center; " class="mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Registrar Actividad</button>
                        </div>  
                </div>
        </div>
       
</form>
<script src="{{ asset('js/campoDinamico.js') }}"></script>
<script src="{{ asset('js/formActividad.js') }}"></script>
