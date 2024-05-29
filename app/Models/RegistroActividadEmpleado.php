<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\subActividad;
use App\Models\Lote;
use App\Models\Empleado;
use App\Models\Actividad;
use App\Models\TipoRendimiento;
class RegistroActividadEmpleado extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'id_empleado',
        'id_lote',
        'id_actividad',
        'id_sub_actividad',
        'id_rendimiento',
        'observaciones'
    ];
    protected $table = 'registro_actividades_empleados';
    
  
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'id_lote');
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'id_actividad');
    }

    public function subActividad()
    {
        return $this->belongsTo(SubActividad::class, 'id_sub_actividad');
    }

    public function rendimiento()
    {
        return $this->belongsTo(TipoRendimiento::class, 'id_rendimiento');
    }
}

