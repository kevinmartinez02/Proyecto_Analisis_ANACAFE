<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroActividadEmpleado;
use App\Models\Actividad;
use App\Models\Lote;
use App\Models\SubActividad;
use App\Models\TipoRendimiento;
use App\Models\TipoEmpleado;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;


class RegistroActividadEmpleadoController extends Controller
{
    public function registrarActividadEmpleado()
    {
        $actividades = Actividad::all();
        $lotes = Lote::all(); // Asumiendo que también tienes un modelo Lote
        return view('formularios.registroActividad', compact('actividades', 'lotes'));
    }

    public function fetchSubActividades(Request $request)
    {
        $subActividades = SubActividad::where('id_actividad', $request->actividad_id)->get(["id", "nombreActividad"]);
        return response()->json($subActividades);
    }
    
        public function buscarEmpleados(Request $request)
        {
            $request->validate([
                'search' => 'required|string', // Validar que el parámetro de búsqueda esté presente y sea una cadena de texto
            ]);
            $empleados = Empleado::whereHas('tipoEmpleado', function ($query) {
                $query->where('tipo_empleado', 'Fijo');
            })
            ->where(function($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->search . '%')
                    ->orWhere('apellido', 'like', '%' . $request->search . '%');
            })
            ->get();
            dd($empleados);
    
        return response()->json($empleados);
        }
    //
    
  
}
