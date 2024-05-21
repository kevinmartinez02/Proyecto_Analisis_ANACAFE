<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEmpleado extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado',
        'id_empleado'
    ];
}
