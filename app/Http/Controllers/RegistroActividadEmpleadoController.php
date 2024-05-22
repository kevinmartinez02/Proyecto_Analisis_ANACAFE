<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroActividadEmpleado;
use App\Models\Actividad;
use App\Models\Lote;
use App\Models\SubActividad;
use App\Models\TipoRendimiento;
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
    //
    
  
}
