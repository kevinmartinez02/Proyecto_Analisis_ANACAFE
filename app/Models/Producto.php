<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

public function store(Request $request)
{
    // Validación de datos
    $request->validate([
        'adress_user' => 'required|unique:users',
        'password_user' => 'required',
        // otras reglas de validación...
    ]);

    // Crear una nueva instancia del modelo User
    $user = new User();
    // Asignar los valores recibidos del formulario
    $user->adress_user = $request->input('adress_user');
    $user->password_user = bcrypt($request->input('password_user')); // Asegura la contraseña utilizando la función bcrypt
    // Guardar el usuario en la base de datos
    $user->save();

    // Redireccionar o devolver una respuesta
    return redirect()->route('login')->with('success', 'Usuario registrado correctamente. Inicie sesión para continuar.');
}
}
