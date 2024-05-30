<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\PDF; 
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\RegistroActividadEmpleado;
class ReporteController extends Controller
{
    //
    public function generatePDF()
    { 
       
        $registros = RegistroActividadEmpleado::with('empleado', 'lote', 'actividad', 'subActividad', 'rendimiento')->get();
        $pdf = PDF::loadView('reportePDF',compact('registros'));
       

        return $pdf->stream();
        /*$data = [
            'title' => 'Reporte de Ejemplo',
            'date' => date('m/d/Y'),
        ];
        
        $pdf = PDF::loadView('report', $data);
        
        return $pdf->download('reporte.pdf');*/
    }
}
