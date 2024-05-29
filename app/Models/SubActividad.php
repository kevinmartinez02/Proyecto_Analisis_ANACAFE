<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actividad;
use App\Models\RegistroActividadEmpleado;

class SubActividad extends Model
{
    use HasFactory;
    protected $table="sub_actividades";
    protected $fillable = [
        'nombreActividad',
        'descripcion',
        'id_actividad'
    ];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'id');
    }
    public function registrosActividades()
    {
        return $this->hasMany(RegistroActividadEmpleado::class, 'id_sub_actividad');
    }
}
