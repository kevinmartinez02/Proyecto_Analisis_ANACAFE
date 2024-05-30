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
use Barryvdh\DomPDF\Facade\PDF; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RegistroActividadEmpleadoController extends Controller
{
    public function registrarActividadEmpleado()
        

    {    $rendimiento = TipoRendimiento::all();
        $empleados = Empleado::whereHas('tipoEmpleado', function ($query) {
        $query->where('tipo_empleado', 'Fijo');
    })->whereHas('estado', function ($query) {
        $query->where('estado', 'Activo');
    })->get();
    $actividades = Actividad::all();
    $lotes = Lote::all(); // Asumiendo que también tienes un modelo Lote
    $tipoEmpleados = TipoEmpleado::all();
    
    return view('formularios.registroActividad', compact('actividades', 'lotes', 'empleados', 'rendimiento','tipoEmpleados'));
        /*$rendimiento = TipoRendimiento::all();
        $empleados = Empleado::whereHas('tipoEmpleado', function ($query) {
            $query->where('tipo_empleado', 'Fijo');
        })->get();
        $actividades = Actividad::all();
        $lotes = Lote::all(); // Asumiendo que también tienes un modelo Lote
        return view('formularios.registroActividad', compact('actividades', 'lotes','empleados','rendimiento'));*/
    }

    public function fetchSubActividades(Request $request)
    {
        $subActividades = SubActividad::where('id_actividad', $request->actividad_id)->get(["id", "nombreActividad"]);
        return response()->json($subActividades);
    }
    public function registroStore(Request $request){
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'fecha' => 'required|date|after_or_equal:2020-01-01|before_or_equal:2026-12-31',
            'lote_id' => 'required|exists:lotes,id',
            'actividad_id' => 'required|exists:actividads,id',
            'sub_actividad_id' => 'required|exists:sub_actividades,id',
            'tipo_rendimiento' => 'required|exists:tipo_rendimientos,id',
            'observaciones' => 'nullable|string|max:255'
        ]);

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
        return redirect()->route('registro.actividad.empleado')->with('success', 'Actividad registrado correctamente');
    }
    public function registrarActividadEmpleadoEventual()
    {
        $rendimiento = TipoRendimiento::all();
        $empleados = Empleado::whereHas('tipoEmpleado', function ($query) {
            $query->where('tipo_empleado', 'Eventual');
        })->get();
        $actividades = Actividad::all();
        $lotes = Lote::all(); // Asumiendo que también tienes un modelo Lote
        return view('formularios.formRegistroActividadEventual', compact('actividades', 'lotes','empleados','rendimiento'));
    }

    public function mostrarRegistrosActividades(Request $request)
{
    
    /*// Obtener los registros de actividades
    $registros = RegistroActividadEmpleado::with('empleado', 'lote', 'actividad', 'subActividad', 'rendimiento');

    // Filtrar por nombre de empleado si se proporciona
    if ($request->has('search')) {
        $registros->whereHas('empleado', function ($query) use ($request) {
            $query->where('nombre', 'LIKE', "%{$request->input('search')}%");
        });
    }

    // Filtrar por rango de fechas si se proporciona
    if ($request->filled('start-date') && $request->filled('end-date')) {
        $registros->whereBetween('fecha', [$request->input('start-date'), $request->input('end-date')]);
    }

    // Obtener los registros después de aplicar los filtros
    $registros = $registros->get();

    // Retornar la vista con los registros de actividades
    if ($request->expectsJson()) {
        return response()->json(view('consultas.tabla_registros', compact('registros'))->render());
    } else {
        return view('consultas.reportes', compact('registros'));
    }*/
    // Obtener los registros de actividades
    // Obtener los registros de actividades
        
        // Obtener los registros de actividades
    $registros = RegistroActividadEmpleado::with('empleado', 'lote', 'actividad', 'subActividad', 'rendimiento');

    // Filtrar por nombre de empleado si se proporciona
    if ($request->has('search') && $request->input('search') !== '') {
        $registros->whereHas('empleado', function ($query) use ($request) {
            $query->where('nombre', 'LIKE', "%{$request->input('search')}%");
        });
    }

    // Filtrar por rango de fechas si se proporciona
    if ($request->filled('start-date') && $request->filled('end-date')) {
        $registros->whereBetween('fecha', [$request->input('start-date'), $request->input('end-date')]);
    }

    // Filtrar por actividad si se proporciona
    if ($request->filled('actividad')) {
        $registros->whereHas('actividad', function ($query) use ($request) {
            $query->where('nombreActividad', $request->input('actividad'));
        });
    }

    // Filtrar por lote si se proporciona
    if ($request->filled('lote')) {
        $registros->whereHas('lote', function ($query) use ($request) {
            $query->where('nombreLote', $request->input('lote'));
        });
    }

    // Filtrar por rendimiento si se proporciona
    if ($request->filled('rendimiento')) {
        $registros->whereHas('rendimiento', function ($query) use ($request) {
            $query->where('tipo_rendimiento', $request->input('rendimiento'));
        });
    }
    $registros = $registros->orderBy('fecha', 'asc');

    // Obtener los registros después de aplicar los filtros
    $registros = $registros->get();

    // Obtener actividades, lotes y rendimientos para los filtros
    $actividades = Actividad::all();
    $lotes = Lote::all();
    $rendimientos = TipoRendimiento::all();
   
    // Retornar la vista con los registros de actividades
    if ($request->expectsJson()) {
        return response()->json(view('consultas.tabla_registros', compact('registros'))->render());
    } else {
        return view('consultas.reportes', compact('registros', 'actividades', 'lotes', 'rendimientos'));
    }
    }

    public function mostrarEditRegistro($id){
         // Obtener el registro de actividad de empleado que se desea editar
         $registro = RegistroActividadEmpleado::findOrFail($id);

         // Puedes acceder directamente a las relaciones relacionadas del registro de actividad de empleado
         $registro->load('empleado', 'lote', 'actividad', 'subActividad', 'rendimiento');
         $lotes = Lote::all();
         $actividades = Actividad::all();
         $rendimiento = TipoRendimiento::all();
        
         // Ahora puedes pasar este registro a tu vista de edición
         return view('formularios.modificarRegistroActividadEmpleado', compact('registro','lotes','actividades','rendimiento'));
    
    }

    public function edit(Request $request, $id){

        $request->validate([
            'fecha' => 'required',
            'lote_id' =>'required',
            'actividad_id' => 'required',
            'sub_actividad_id' =>'required',
            'tipo_rendimiento' => 'required',
            'observaciones' => 'required',
        ]);
    
        $registro = RegistroActividadEmpleado::findOrFail($id);
        $registro->fecha = $request->fecha;
        $registro->id_lote = $request->lote_id;
        $registro->id_actividad = $request->actividad_id;
        $registro->id_sub_actividad = $request->sub_actividad_id;
        $registro->id_rendimiento = $request->tipo_rendimiento;
        $registro->observaciones = $request->observaciones;
        $registro->save();
    
        return redirect()->route('mostrar.actividades.empleado')->with('success', 'Actualizado Correctamente');
    }

    public function  delete ($id){
        $registro = RegistroActividadEmpleado::findorFail($id);
        $registro->delete();
        return redirect()->route('mostrar.actividades.empleado')->with('success','REgistro Eliminado Exitosamente');
    }
    public function generatePDF(Request $request)
    { 
        $startDate = $request->input('start-date');
    $endDate = $request->input('end-date');

    $registros = RegistroActividadEmpleado::with('empleado', 'lote', 'actividad', 'subActividad', 'rendimiento')
        ->whereBetween('fecha', [$startDate, $endDate])
        ->orderBy('fecha')
        ->get()
        ->groupBy(function($item) {
            return Carbon::parse($item->fecha)->format('Y-m-d');
        })
        ->map(function($group) {
            return $group->groupBy('empleado_id');
        });

    $pdf = PDF::loadView('reportePDF', compact('registros'));
    return $pdf->download('reporte.pdf');
    }
}

  

