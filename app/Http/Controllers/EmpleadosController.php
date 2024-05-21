<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\FechaIngreso;
use App\Models\EstadoEmpleado;
use App\Models\TipoEmpleado;

class EmpleadosController extends Controller
{
    //public 
        public function create(){

            $tipos_empleados = TipoEmpleado::all();
            return view('formRegistro',compact('tipos_empleados'));
        }
        public function store(Request $request){
            // Validate that incoming data is correct
            $request->validate([
                'dpi' => ['required', 'unique:empleados', 'size:13', 'regex:/^\d+$/'],
                'nombre' => 'required',
                'numeroIGSS' => ['required','size:13','regex:/^\d+$/'],
                'nit' => ['required', 'unique:empleados' , 'size:9']

            ]);
            $tipoEmpleadoId = $request->input('tipo_empleado');


            
            //script para registro de un nuevo empleado
            $empleados = new Empleado;
            $empleados->nombre = $request->nombre;
            $empleados->apellido = $request->apellido;
            $empleados->id_tipo_empleado = $tipoEmpleadoId;
            $empleados->dpi = $request->dpi;
            $empleados->numeroIGSS = $request->numeroIGSS;
            $empleados->nit = $request->nit;
            $empleados->direccion = $request->direccion;
            $empleados->numeroTelefono = $request->numeroTelefono;
            $empleados->save();
            //script para estado de empleado
            $estadoempleado = new EstadoEmpleado;
            $estadoempleado->id_empleado = $empleados->id;
            $estadoempleado->estado = 'Activo';
            $estadoempleado->save();
            //script para fecha de ingreso del cliente
            
            return redirect()->back()->with('success', 'Empleado registrado correctamente');
        
       

        }

        public function mostrarEmpleados(Request $request)
        {
            $query = $request->input('search');
        
            // Si hay un término de búsqueda, filtrar los empleados
            if ($query) {
                $empleados = Empleado::where('nombre', 'LIKE', "%{$query}%")
                    ->orWhere('apellido', 'LIKE', "%{$query}%")
                    ->get();
            } else {
                // Si no hay un término de búsqueda, mostrar todos los empleados
                $empleados = Empleado::all();
            }
        
            return view('consultas.mostrarEmpleado', compact('empleados'));
        }
        
        
        

        
}
