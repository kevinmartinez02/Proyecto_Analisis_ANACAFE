<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FechaIngreso extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_empleado',
        'fecha_ingreso'
    ];
    protected $table = 'fecha_ingresos_empleados';
}
