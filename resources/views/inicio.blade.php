@extends('layouts.principal')
@include('layouts.navigation')
    
    
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-black">
                <h1 class="bienvenida-title">Bienvenido al Sistema de Gestión de Empleados</h1>
                <p class="bienvenida-parrafo">Gestiona eficazmente la información de tus empleados, registra sus activiades diaras y genera reportes detallados.</p>
                </div>
            </div>
        </div>
    </div>
    
   
    <main>
       
        <section class="dashboard">
            <div class="card">
                <img src="/css/empleado.png" alt="Ilustración">
                <div class="card-content">
                    <h3>Registro de Actividades</h3>
                    <p>Accede al módulo de Registro de actividades para empleado, permite añadir, editar o eliminar registros.</p>
                    <button onclick="location.href='{{route('registro.actividad.empleado')}}'">Registro de actividades</button>
                </div>
            </div>
        </section>
        <section class="acciones">
            <h2 class="acciones-title">Acciones Rápidas</h2>
            <button onclick="location.href='{{ route('registro.empleado') }}'">Añadir Nuevo Empleado</button>
            <button onclick="location.href='{{route('mostrar.empleados')}}'">Mostrar empleados</button>
            <button onclick="location.href='{{route('mostrar.actividades.empleado')}}'">Generar Reporte</button>
        </section>
            </main>
    <footer>
        <p>&copy; 2024 Sistema de Gestión de Empleados. Todos los derechos reservados.</p>
    </footer>