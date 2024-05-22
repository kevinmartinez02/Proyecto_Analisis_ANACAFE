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
        $rendimiento = TipoRendimiento::all();
        $empleados = Empleado::whereHas('tipoEmpleado', function ($query) {
            $query->where('tipo_empleado', 'Fijo');
        })->get();
        $actividades = Actividad::all();
        $lotes = Lote::all(); // Asumiendo que también tienes un modelo Lote
        return view('formularios.registroActividad', compact('actividades', 'lotes','empleados','rendimiento'));
    }

    public function fetchSubActividades(Request $request)
    {
        $subActividades = SubActividad::where('id_actividad', $request->actividad_id)->get(["id", "nombreActividad"]);
        return response()->json($subActividades);
    }
    public function registroStore(Request $request){
        $empleadoId = $request->input('empleado_id');
        $fecha = $request->fecha;
        $loteId = $request->input('lote_id');
        $actividadId = $request->input('actividad_id');
        $subActividadId = $request->input('sub_actividad_id');
        $rendimientoId = $request->input('tipo_rendimiento');
        $description = $request->observaciones;
        $newActividadEmpleado = new RegistroActividadEmpleado;
        $newActividadEmpleado->fecha = $fecha;
        $newActividadEmpleado->id_empleado = $empleadoId;
        $newActividadEmpleado->id_lote = $loteId;
        $newActividadEmpleado->id_actividad = $actividadId;
        $newActividadEmpleado->id_sub_actividad = $subActividadId;
        $newActividadEmpleado->id_rendimiento = $rendimientoId;
        $newActividadEmpleado->observaciones = $description;
        $newActividadEmpleado->save();
        return redirect()->back()->with('success', 'Actividad registrado correctamente');
    }
    
    
    //
    
  
}
