<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Render vista 
   * 
   * @return view
   */
  public function config()
  {
    return view('user.config');
  }

  /**
   * Actualiza los datos del usuario
   * 
   * @param Request $request Datos del formulario
   * 
   * @return redirect con un mensaje
   */
  public function update(Request $request)
  {
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

    //Subir img de perfil
    $image_path = $request->file('image_path');    
    if ($image_path) {
      $image_name = time() . $image_path->getClientOriginalName();
      \Storage::disk('users')->put($image_name, \File::get($image_path));      
      $user->image = $image_name;
    } 

    //Ejecutar query 
    $user->update();

    return redirect()->route('config')->with(array(
      'message' => 'Usuario actualizado correctamente'
    ));
  }


  /**
   * Obtener la img del \Storage
   * 
   * @param $filename Nombre de la img
   * 
   * @return Response img en base_64
   */
  public function getImage($filename) {
    $file = \Storage::disk('users')->get($filename);

    return new Response($file, 200);
  }

  public function profile($id) {
    $user = User::find($id);
    //var_dump($user); die();
    return view('user.profile', array(
      'user' => $user
    ));

  }
}
