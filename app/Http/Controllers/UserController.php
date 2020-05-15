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
     * @sreturn 
     */
    public function update(Request $request) {
        //Obetener los datos que llegan desde el formulario
        $id = \ Auth::user()->id; //Obtener el id de usuario logeado
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');  
        
        var_dump($id);
        var_dump($name);
        var_dump($nick);
        var_dump($email);
        die();



    }
}
