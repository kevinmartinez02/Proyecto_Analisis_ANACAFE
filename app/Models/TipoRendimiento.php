<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroActividadEmpleado;
class TipoRendimiento extends Model
{
    use HasFactory;

    public function registrosActividades()
    {
        return $this->hasMany(RegistroActividadEmpleado::class, 'id_rendimiento');
    }
}
