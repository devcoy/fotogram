<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Restringir el acceso usando un middleware a nivel controlador
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {

        // Validar información
        $validate = $this->validate($request, array(
            'image_id' => 'required|integer',
            'content' => 'required|string'
        ));

        // Obtener datos del formulario
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        // Obtener datos del usuario loguaeado
        $user = \Auth::user();

        // Seteo los valor al obj a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        // Redirigir
        return redirect()->route('image.detail', array('id' => $image_id))->with(array(
            'message' => 'Comentario publicado'
        ));
    }

    public function delete($id)
    {
        // Conseguir los datos del usuario identificado
        $user = \Auth::user();

        // Condeguir el objeto del comentario
        $comment = Comment::find($id);

        // Comprobar si soy el dueño del comentario o de la publicación
        if ($user && ($comment->user_id === $user->id || $comment->image->user_id === $user->id)) {
            $comment->delete(); // Eliminar comentario de la BD
            // Redirigir
            return redirect()->route('image.detail', array('id' => $comment->image->id))->with(array(
                'message' => 'Comentario eliminado'
            ));
        } else {
            // Redirigir
            return redirect()->route('image.detail', array('id' => $comment->image->id))->with(array(
                'message' => 'El comentario no se ha podido eliminar'
            ));
        }
    }
}
