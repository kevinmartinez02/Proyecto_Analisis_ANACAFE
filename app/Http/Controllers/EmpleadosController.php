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
            $search = $request->get('search');
    $empleados = Empleado::with(['estado','tipoEmpleado'])
        ->where('nombre', 'like', "%{$search}%")
        ->orWhere('apellido', 'like', "%{$search}%")
        ->get();

    return view('consultas.mostrarEmpleado', compact('empleados'));
           /* $query = $request->input('search');

         // Si hay un término de búsqueda, filtrar los empleados
                 if ($query) {
                         $empleados = Empleado::with('estado')
                         ->where('nombre', 'LIKE', "%{$query}%")
                        ->orWhere('apellido', 'LIKE', "%{$query}%")
                    ->get();
                } else {
                     // Si no hay un término de búsqueda, mostrar todos los empleados
                        $empleados = Empleado::with('estado')->get();
                    }
            
            return view('consultas.mostrarEmpleado', compact('empleados'));*/
        }

        public function mostrarModificarDatosEmpleado($id){
              // Obtener el empleado que se va a modificar
    $empleado = Empleado::findOrFail($id);
    
    // Obtener todos los tipos de empleados disponibles
    $tipos_empleados = TipoEmpleado::all();
    
    // Obtener el tipo de empleado asociado al empleado actual
    $tipo_empleado_asociado = $empleado->tipoEmpleado;

    // Pasar los datos del empleado, tipos de empleados y tipo de empleado asociado a la vista
    return view('formularios.modificarDatosEmpleados', compact('empleado', 'tipos_empleados', 'tipo_empleado_asociado'));
           /* $empleado = Empleado::find($id);
            $tipos_empleados = TipoEmpleado::all();
            $tipoEmpleado = Empleado::with('tipoEmpleado')->get();
            return view('formularios.modificarDatosEmpleados',compact('empleado','tipos_empleados','tipoEmpleado'));*/
        }
        public function actualizarDatosEmpleado(Request $request,$id){
            $request->validate([
                
                'tipo_empleado' => 'required|exists:tipo_empleados,id', // Validación del tipo de empleado
                'nombre' => 'required',
                'apellido' => 'required',
                'dpi' => 'required',
                'numeroIGSS' => 'required',
                'direccion' => 'required',
                'numeroTelefono' => 'required',
               


            ]);
            
            $empleadoEncontrado = Empleado::findOrFail($id);
            $empleadoEncontrado->nombre = $request->nombre;
            $empleadoEncontrado->apellido = $request->apellido;
            $empleadoEncontrado->id_tipo_empleado = $request->input('tipo_empleado');
            $empleadoEncontrado->dpi = $request->dpi;
            $empleadoEncontrado->numeroIGSS = $request->numeroIGSS;
            $empleadoEncontrado->nit = $request->nit;
            $empleadoEncontrado->direccion = $request->direccion;
            $empleadoEncontrado->numeroTelefono = $request->numeroTelefono;
            $empleadoEncontrado->save();
            return redirect()->route('mostrar.empleados')->with('success', 'Empleado Actualizado correctamente');
        }
        
        public function deleteEmpleado($id){
            $empleado = Empleado::findOrFail($id);
        
        // Eliminar el empleado (los registros relacionados se eliminarán automáticamente)
        $empleado->delete();

        return redirect()->back()->with('success', 'Empleado eliminado correctamente');
        }

   
        public function fetchEmpleados(Request $request)
        {/*
            // Obtiene el parámetro de búsqueda enviado por Select2
            $search = $request->input('q');
    
            // Realiza la consulta en la base de datos para encontrar empleados que coincidan con el término de búsqueda
            $empleados = Empleado::where('nombre', 'LIKE', "%{$search}%")
                                 ->orWhere('apellido', 'LIKE', "%{$search}%")
                                 ->get();
    
            // Prepara los datos en el formato requerido por Select2
            $response = [];
            foreach ($empleados as $empleado) {
                $response[] = [
                    'id' => $empleado->id,
                    'text' => $empleado->nombre . ' ' . $empleado->apellido
                ];
            }
    
            // Devuelve la respuesta en formato JSON
            return response()->json($response);*/
             // Obtiene el parámetro de búsqueda enviado por Select2
    $search = $request->input('q');
    $tipoEmpleadoId = $request->input('tipo_empleado_id');
    
    // Realiza la consulta en la base de datos para encontrar empleados que coincidan con el término de búsqueda y el tipo de empleado
    $empleados = Empleado::where('id_tipo_empleado', $tipoEmpleadoId)
                         ->where(function($query) use ($search) {
                             $query->where('nombre', 'LIKE', "%{$search}%")
                                   ->orWhere('apellido', 'LIKE', "%{$search}%");
                         })
                         ->get();

    // Prepara los datos en el formato requerido por Select2
    $response = [];
    foreach ($empleados as $empleado) {
        $response[] = [
            'id' => $empleado->id,
            'text' => $empleado->nombre . ' ' . $empleado->apellido
        ];
    }

    // Devuelve la respuesta en formato JSON
    return response()->json($response);
        }
    }
        
     

        

