<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEmpleado extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_empleado',
        'estado'
    ];
    protected $table = 'estado_empleados';
}
