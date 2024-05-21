<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
