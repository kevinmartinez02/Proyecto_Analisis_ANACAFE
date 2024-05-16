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

    public function store(Request $reques){
        $nombre_actividad = $request->input('nombreActividad');
        $subActividades = $request->input('nombre_subactividad');
        $subActividadesDescription = $request->input('descripcion');

        $actividad = new Actividad;
        $actividad->nombreActividad = $nombre_actividad;
        $actividad->save();
        
    

        foreach ($subactividad as $index => $subactividad) {
            $sub = new Subactividad();
            $sub->nombre = $subactividad;
            $sub->descripcion = $descripciones[$index]; // Asociar la descripción con la subactividad
            $sub->actividad_id = $actividad->id; // Asociar la subactividad con la actividad principal
            $sub->save();
        }

        return redirect()->route('registro.actividad');
    }
}
