<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstadoEmpleado;
use App\Models\empleados;
class EstadosController extends Controller
{
    //

    public function mostrarEstadoEmpleados(){
        /*$estados = empleados::join('estado_empleados', 'empleados.id', '=', 'estado_empleados.id_empleado')
        ->select('empleados.*', 'estado_empleados.estado')
        ->get();

    // Pasar los datos a la vista
    return view('consultas.estados', compact('estados'));*/
      // Obtener el término de búsqueda, si se proporciona
      $search = request('search');

      // Construir la consulta para obtener los empleados con sus estados correspondientes
      $query = empleados::join('estado_empleados', 'empleados.id', '=', 'estado_empleados.id_empleado')
          ->select('empleados.*', 'estado_empleados.estado');
  
      // Aplicar el filtro de búsqueda si se proporciona
      if ($search) {
          $query->where(function($query) use ($search) {
              $query->where('empleados.nombre', 'like', '%' . $search . '%')
                    ->orWhere('empleados.apellido', 'like', '%' . $search . '%');
          });
      }
  
      // Ejecutar la consulta
      $estados = $query->get();
  
      // Pasar los datos a la vista
      return view('consultas.estados', compact('estados'));
     }
     
     public function updateEstado(Request $request)
    {
        $empleadoId = $request->input('empleado_id');
        $estadoEmpleado = EstadoEmpleado::where('id_empleado', $empleadoId)->firstOrFail();

        // Cambiar el estado del empleado
        $estadoEmpleado->estado = $estadoEmpleado->estado === "Activo" ? "Inactivo" : "Activo";
        $estadoEmpleado->save();

        // Retornar el estado actualizado como respuesta
        return response()->json(['estado' => $estadoEmpleado->estado]);
    }

        
 }

    

