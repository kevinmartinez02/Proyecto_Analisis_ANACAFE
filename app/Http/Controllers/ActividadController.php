<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\SubActividad;

class ActividadController extends Controller
{
    //
    public function index(){
        return view('formularios.formRegActividad');
    }

    public function store(Request $request){

        $request->validate([
            'nombreActividad' => ['required', 'unique:actividads'],
            'nombreSubactividad' => ['required_without_all:descripcion.*'],
            'descripcion' => ['required_without_all:nombreSubactividad.*'],
        ], [
            'nombreSubactividad.required_without_all' => 'Debes ingresar al menos una subactividad',
            'descripcion.required_without_all' => 'Debes ingresar al menos una descripción',
        ]);
        
       $nombre_actividad = $request->input('nombreActividad');
        $subActividades = $request->input('nombreSubactividad');
        $subActividadesDescription = $request->input('descripcion');

        $actividades = new Actividad();
        $actividades->nombreActividad = $nombre_actividad;
        $actividades->save();
        
    

        foreach ($subActividades as $index => $subactividad) {
            $sub = new SubActividad();
            $sub->nombreActividad = $subactividad;
            $sub->descripcion =$subActividadesDescription [$index]; // Asociar la descripción con la subactividad
            $sub->id_actividad= $actividades->id; // Asociar la subactividad con la actividad principal
            $sub->save();
        }

        return redirect()->route('registro.actividad')->with('success','Actividad Registrada Exitosamente');
    }

    public function mostrar(Request $request)
    {
        $search = $request->get('search', '');

        $actividades = Actividad::with('subActividades')
            ->where('nombreActividad', 'like', "%{$search}%")
            ->paginate(10);

        return view('consultas.mostrarActividades', compact('actividades'));
    }

    public function destroy($id)
    {
        /*$actividad = Actividad::findOrFail($id);
        $actividad->delete();

        return redirect()->route('mostrar.actividades')->with('success', 'Actividad eliminada correctamente.');*/
        try {
            $actividad = Actividad::findOrFail($id);
            $actividad->delete();

            return response()->json(['message' => 'Actividad eliminada correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hubo un problema al eliminar la actividad.'], 500);
        }
    }
        
    
    public function edit($id)
    {
        $actividad = Actividad::with('subActividades')->findOrFail($id);
        return view('formularios.editActividades', compact('actividad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreActividad' => 'required',
            'nombreSubactividad' => ['required_without_all:descripcion.*'],
            'descripcion' => ['required_without_all:nombreSubactividad.*'],
        ], [
            'nombreSubactividad.required_without_all' => 'Debes ingresar al menos una subactividad',
            'descripcion.required_without_all' => 'Debes ingresar al menos una descripción',
        ]);
        
        $actividad = Actividad::findOrFail($id);
        $actividad->nombreActividad = $request->nombreActividad;
        $actividad->save();

        // Borrar subactividades existentes
        SubActividad::where('id_actividad', $id)->delete();

        // Crear nuevas subactividades
        foreach ($request->nombreSubactividad as $index => $nombreSubactividad) {
            SubActividad::create([
                'id_actividad' => $id,
                'nombreActividad' => $nombreSubactividad,
                'descripcion' => $request->descripcion[$index],
            ]);
        }

        return redirect()->route('mostrar.actividades')->with('success', 'Actividad actualizada exitosamente.');
    }
}

