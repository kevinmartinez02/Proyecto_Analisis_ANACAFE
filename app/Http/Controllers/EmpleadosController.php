<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleados;

class EmpleadosController extends Controller
{
    //public 
        public function create(){
            return view('formRegistro');
        }
        public function store(Request $request){
            $empleados = new empleados;
            $empleados->nombre = $request->nombre;
            $empleados->apellido = $request->apellido;
            $empleados->dpi = $request->dpi;
            $empleados->numeroIGSS = $request->numeroIGSS;
            $empleados->nit = $request->nit;
            $empleados->direccion = $request->direccion;
            $empleados->numeroTelefono = $request->numeroTelefono;
            $empleados->save();
            return redirect()->route('registro.empleado');
        }

        public function show($id){
            $id = empleados::find($id);
            return view('mostrar',compact('id'));
        }
}
