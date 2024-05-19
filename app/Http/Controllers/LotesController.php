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

}
