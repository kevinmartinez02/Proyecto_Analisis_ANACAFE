<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class saveDBase extends Controller
{
    //protected $table = 'users';
    public function guardarDatos(Request $request)
    {
    // Validar los datos del formulario si es necesario
    $request->validate([
        'adress_user' => 'required',
        'password_user' => 'required',
    ]);

    // Crear un nuevo objeto de modelo User con los datos del formulario
    $user = new User();
    $user->adress_user = $request->input('adress_user');
    $user->password_user = bcrypt($request->input('password_user')); // Se recomienda cifrar la contraseña

    // Guardar el objeto en la base de datos
    $user->save();

    // Opcional: puedes devolver una respuesta o redireccionar a otra página
    return redirect()->route('welcome')->with('success', 'Los datos se han guardado correctamente.');
}
}
