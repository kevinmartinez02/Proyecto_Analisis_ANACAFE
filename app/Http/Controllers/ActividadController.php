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
            'nombreActividad' => ['required', 'unique:actividads']
        ]);
       $nombre_actividad = $request->input('nombreActividad');
        $subActividades = $request->input('nombreSubactividad');
        $subActividadesDescription = $request->input('descripcion');

        $actividades = new Actividad();
        $actividades->nombreActividad = $nombre_actividad;
        $actividades->save();
        
    

        foreach ($subActividades as $index => $subactividad) {
            $sub = new SubActividad();
            $sub->nombreSubActividad = $subactividad;
            $sub->descripcion =$subActividadesDescription [$index]; // Asociar la descripción con la subactividad
            $sub->id_actividad= $actividades->id; // Asociar la subactividad con la actividad principal
            $sub->save();
        }

        return redirect()->route('registro.actividad');
    }
}
