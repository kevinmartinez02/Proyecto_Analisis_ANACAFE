<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEmpleado extends Model
{
    use HasFactory;
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'id');
    }
}
