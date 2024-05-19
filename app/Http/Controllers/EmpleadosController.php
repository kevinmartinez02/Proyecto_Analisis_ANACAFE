<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleados;
use App\Models\FechaIngreso;
use App\Models\EstadoEmpleado;

class EmpleadosController extends Controller
{
    //public 
        public function create(){
            return view('formRegistro');
        }
        public function store(Request $request){
            // Validate that incoming data is correct
            $request->validate([
                'dpi' => ['required', 'unique:empleados', 'size:13', 'regex:/^\d+$/'],
                'nombre' => 'required',
                'numeroIGSS' => ['required','size:13','regex:/^\d+$/'],
                'nit' => ['required', 'unique:empleados' , 'size:9']

            ]);

            
            //script para registro de un nuevo empleado
            $empleados = new empleados;
            $empleados->nombre = $request->nombre;
            $empleados->apellido = $request->apellido;
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
            $fechaingreso = new FechaIngreso;
            $fechaingreso->id_empleado = $empleados->id;
            $fechaingreso->fecha_ingreso = now()->toDateString();
            $fechaingreso->save();
            
            return redirect()->back()->with('success', 'Empleado registrado correctamente');
        
       

        }

        public function mostrarEmpleados(){
            $encontrado = empleados::all();
            return view('consultas.mostrarEmpleado',compact('encontrado'));
        }
        
        protected  function mostrarEmpleado($user){
            return view('consultas.mostrarEmpleadoBuscado',compact('user'));
    
        }
        public function buscarEmpleado(Request $request){
            $encontrado = empleados::where('nombre', $request->nombre)->first();
            return $this->mostrarEmpleado($encontrado);
        }
        public function mostrarViewBuscarEmpleado(){
            return view('consultas.buscarEmpleado');
        }


        
}
