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
<form id="form" action="{{ $actividad->id ? route('actualizar.actividad', $actividad->id) : route('registro.actividad.store') }}" method="POST">
    @csrf
    @if($actividad->id)
        @method('PUT')
    @endif
    <div class="container-md text-center mt-4">
        <h1 style="color: green; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">{{ $actividad->id ? 'Modificar Actividad' : 'Registrar Actividad' }}</h1>

        <section class="shadow-lg p-3 mb-5 bg-body-tertiary rounded mt-4">
            <div class="container-md text-center">
                <div class="container-md text-center mt-4 ">
                    <h1 style="color: green; font-family: Arial, sans-serif; font-size: 20px; font-weight: bold; margin: 20px 0;">Actividad</h1>
                </div>
                <div class="contaniner-lg row align-items-start">
                    <div class="col">
                        <!-- espacio para ingresar nombre de actividad -->
                        <div class="col form-floating mb-3">
                            <input type="text" name="nombreActividad" class="form-control" id="nombre" value="{{ old('nombreActividad', $actividad->nombreActividad) }}">
                            <label for="floatingInput">Nombre de actividad</label>
                        </div>
                    </div>
                </div>
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
            <div class="container" id="dinamic">
                @foreach ($actividad->subActividades as $subActividad)
                    <div class="container-lg p-1 g-col-6 mb-3">
                        <label>{{ $loop->iteration }}</label> - 
                        <input type="text" name="nombreSubactividad[]" value="{{ $subActividad->nombreActividad }}" placeholder="Nombre" required> 
                        <input type="text" name="descripcion[]" style="height: 50px; vertical-align: top;" value="{{ $subActividad->descripcion }}" placeholder="Descripción" required>
                        <button onclick="eliminar(this)" type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                @endforeach
            </div>
            <!-- botton para enviar informacion de Actividad -->
            <div style="text-align: center; " class="mt-4">
                <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">
                    {{ $actividad->id ? 'Actualizar Actividad' : 'Registrar Actividad' }}
                </button>
            </div>  
        </div>
    </div>
</form>

<script src="{{ asset('js/campoDinamico.js') }}"></script>
<script src="{{ asset('js/formActividad.js') }}"></script>