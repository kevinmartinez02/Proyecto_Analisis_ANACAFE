<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroActividadEmpleado;

class Lote extends Model
{
    use HasFactory;
    protected $fillable =[
                'nombreLote',
                'area'
    ];
    public function registrosActividades()
    {
        return $this->hasMany(RegistroActividadEmpleado::class, 'id_lote');
    }
}
