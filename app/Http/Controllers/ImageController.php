<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Image;
use App\Like;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  // Restringir el acceso usando un middleware a nivel controlador
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Subir imagen view
   * 
   * @return view
   */
  public function create()
  {
    return view('image.create');
  }

  /**
   * Subir imagen
   * 
   * @param Request $request Datos enviados desde el formulario
   *
   *  @return 
   */
  public function save(Request $request)
  {
    //Obtener el usuario logueado
    $user = \Auth::user();


    //Validación de datos
    $validate = $this->validate($request, array(
      'description' => 'required',
      'image_path' => 'required|mimes:jpg,jpeg,png,gif'
    ));

    $image_path = $request->file('image_path');
    $description = $request->input('description');

    //Setear valore nuevos
    $image = new Image();
    $image->description = $description;
    $image->user_id = $user->id;

    //Subri archivo y setearlo
    if ($image_path) {
      $image_name = time() . $image_path->getClientOriginalName();
      \Storage::disk('images')->put($image_name, \File::get($image_path));
      $image->image_path = $image_name;
    }

    $image->save();

    return redirect()->route('home')->with(array(
      'message' => 'Se ha publicado la foto correctamente'
    ));
  }


  /**
   * Obtener la image
   * 
   * @param string $filename Nombre del archivo
   * 
   * @return Response $file Archivo
   */
  public function getImage($filename)
  {
    $file = \Storage::disk('images')->get($filename);

    return new Response($file, 200);
  }


  /** 
   * Detalle de una imagen
   * 
   * @param integer $id Id de la imagen a mostrar
   * 
   * @return view Vista de la imagen renderizada
   * 
   */
  public function detail($id)
  {
    $image = Image::find($id); //Obtener la imagen

    return view('image.detail', array(
      'image' => $image
    ));
  }


  /**
   * Eliminar una publicación
   */
  public function delete($id)
  {
    $user = \Auth::user();
    $image = Image::find($id);
    $comments = Comment::where('image_id', $id)->get();
    $likes = Like::where('image_id', $id)->get();

    if ($user && $image && $image->user_id === $user->id) {
      // Eliminar comentarios 
      if ($comments && count($comments) > 0) {
        foreach ($comments as $comment) {
          $comment->delete();
        }
      }

      // Eliminar likes
      if ($likes && count($likes) > 0) {
        foreach ($likes as $like) {
          $like->delete();
        }
      }

      // Eliminar ficheros de la img del storage
      Storage::disk('images')->delete($image->image_path);

      // Eliminar el registro de la imagen
      $image->delete();

      $message = 'La imagen se elimino correctamente';
    } else {
      $message = 'No se pudo eliminar la imagen';
    }

    return redirect()->route('home')->with(array(
      'message' => $message
    ));
  }

  /**
   * Editar una publicación
   */
  public function edit($id) {
    $user = \Auth::user();
    $image = Image::find($id);

    if($user && $image && $image->user->id === $user->id) {
      return view('image.edit', array(
        'image' => $image
      ));
    } else {
      return redirect()->route('home');
    }
  }
}
