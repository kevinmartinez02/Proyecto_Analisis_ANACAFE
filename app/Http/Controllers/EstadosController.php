<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstadoEmpleado;
use App\Models\Empleado;
class EstadosController extends Controller
{
    //

    public function mostrarEstadoEmpleados(Request $request){
        $search = $request->get('search');

    $query = Empleado::query();

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nombre', 'like', '%' . $search . '%')
              ->orWhere('apellido', 'like', '%' . $search . '%');
        });
    }

    // Assuming you have a relationship or directly in the 'empleados' table
    $estados = $query->get();

    return view('consultas.estados', compact('estados'));
}
       /* $estados = Empleado::join('estado_empleados', 'empleados.id', '=', 'estado_empleados.id_empleado')
        ->select('empleados.*', 'estado_empleados.estado')
        ->get();

    // Pasar los datos a la vista
    return view('consultas.estados', compact('estados'));*/
      // Obtener el término de búsqueda, si se proporciona
      /*$search = $request('search');

      // Construir la consulta para obtener los empleados con sus estados correspondientes
      $query = Empleado::join('estado_empleados', 'empleados.id', '=', 'estado_empleados.id_empleado')
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
      return view('consultas.estados', compact('estados'));*/

    
     
     
     public function updateEstado(Request $request)
    {$request->validate([
        'empleado_id' => 'required|integer|exists:empleados,id',
    ]);

    $empleado = Empleado::findOrFail($request->empleado_id);
    $nuevoEstado = $empleado->estado === 'Activo' ? 'Inactivo' : 'Activo';
    $empleado->estado = $nuevoEstado;
    $empleado->save();

    return response()->json(['estado' => $nuevoEstado]);
        /*$request->validate([
            'empleado_id' => 'required|integer|exists:empleados,id',
        ]);
    
        $estadoEmpleado = EstadoEmpleado::where('id_empleado', $request->empleado_id)->first();
    
        if ($estadoEmpleado) {
            $nuevoEstado = $estadoEmpleado->estado === 'Activo' ? 'Inactivo' : 'Activo';
            $estadoEmpleado->update(['estado' => $nuevoEstado]);
    
            return response()->json(['estado' => $nuevoEstado]);
        }
    
        return response()->json(['error' => 'Empleado no encontrado'], 404);*/
        /*
        $empleadoId = $request->input('empleado_id');
        $estadoEmpleado = EstadoEmpleado::where('id_empleado', $empleadoId)->firstOrFail();

        // Cambiar el estado del empleado
        $estadoEmpleado->estado = $estadoEmpleado->estado === "Activo" ? "Inactivo" : "Activo";
        $estadoEmpleado->save();

        // Retornar el estado actualizado como respuesta
        return response()->json(['estado' => $estadoEmpleado->estado]);*/
    }

        
 }

    


