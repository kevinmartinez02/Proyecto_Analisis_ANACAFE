<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActividad extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombreActividad',
        'descripcion',
        'id_actividad'
    ];
}
