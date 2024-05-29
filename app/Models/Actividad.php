<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubActividad;
use App\Models\RegistroActividadEmpleado;

class Actividad extends Model
{
    use HasFactory;
   
    protected $fillable = ['nombreActividad'];
    public function subActividades()
    {
        return $this->hasMany(SubActividad::class, 'id_actividad');
    }
    public function registrosActividades()
    {
        return $this->hasMany(RegistroActividadEmpleado::class, 'id_actividad');
    }
}
