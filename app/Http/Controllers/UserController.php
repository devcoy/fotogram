<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    /**
     * Render vista 
     * 
     * @return view
     */
    public function config() {
        return view('user.config');
    }

    /**
     * Actualiza los datos del usuario
     * 
     * @param Request $request Datos del formulario
     * 
     * @return redirect Array con un mensaje
     */
    public function update(Request $request) {

        //Obtener el usuario logeado
        $user = \Auth::user(); 
        
        //Validar el formulario 
        $validate = $this->validate($request, array(
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            //comprueba que el email es único, con la excepción de que cuando sea el del mismo usuario logeado sea valido
            'nick' => 'required|string|max:255|unique:users,nick, ' . $user->id,
            'email' => 'required|email|max:255|unique:users,email, ' . $user->id,
        ));

        //Obetener los datos que llegan desde el formulario        
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');  
        
        // Setear los nuevos valores al obj user
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Ejecutar query 
        $user->update();

        return redirect()->route('config')->with(array(
            'message' => 'Usuario actualizado correctamente'
        ));        
    }
}
