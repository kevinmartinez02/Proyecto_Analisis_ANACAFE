<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable =[
        'nombre',
        'apellido',
        'id_tipo_empleado',
        'dpi',
        'numeroIGSS',
        'nit',
        'direccion',
        'numeroTelefono'
    ];
}
