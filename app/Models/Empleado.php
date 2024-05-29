<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoEmpleado;
use App\Models\EstadoEmpleado;
use App\Models\RegistroActividadEmpleado;

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
    public function tipoEmpleado()
    {
        return $this->belongsTo(TipoEmpleado::class, 'id_tipo_empleado');
    }
    public function estado()
    {
        return $this->hasOne(EstadoEmpleado::class, 'id_empleado');
    }

    // Relación con RegistroActividadesEmpleado
    public function registroActividades()
    {
        return $this->hasMany(RegistroActividadEmpleado::class, 'id_empleado');
    }
    

    // Relación con EstadoEmpleado
    public function estadoEmpleados()
    {
        return $this->hasMany(EstadoEmpleado::class, 'id_empleado');
    }
    
    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($empleado) {
            $empleado->registroActividades()->delete();
            $empleado->estadoEmpleados()->delete();
        });
    }
}
