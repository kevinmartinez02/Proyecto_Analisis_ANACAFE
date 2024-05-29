<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;

class LotesController extends Controller
{
    //
    public function index(){
        return view('formularios.formLote');
    }
    public function store(Request $request){

        $request->validate([
            'nombreLote'=> ['required', 'unique:lotes'],
            'area' => 'required'
        ]);

        $lote = new Lote;
        $lote->nombreLote = $request->nombreLote;
        $lote->area = $request->area;
        $lote->save();
        return redirect()->route('registro.lote');
    }
    public function mostrarLotes(Request $request){
        $search = $request->get('search', '');

        $lotes = Lote::where('nombreLote', 'like', "%{$search}%")
            ->get();

      
        return view('consultas.mostrarLotes',compact('lotes'));
    }
    public function updateLotes($id){
        $lote = Lote::findOrFail($id);
        return view('formularios.modificarLote',compact('lote'));

    }
    public function edit(Request $request, $id){
        $request->validate([
            'nombreLote'=> ['required'],
            'area' => 'required'
        ]);
        $lote = Lote::findOrFail($id);
        $lote->nombreLote = $request->nombreLote;
        $lote->area = $request->area;
        $lote->save();
        return redirect()->route('mostrar.lotes')->with('success', 'Actividad actualizada exitosamente.');
    }

    public function delete(Request $request, $id){
        $lote = Lote::findOrFail($id);
        $lote->delete();
        return redirect()->route('mostrar.lotes')->with('success', 'Actividad eliminada correctamente.');
    }
    }


