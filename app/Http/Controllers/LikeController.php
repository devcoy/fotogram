<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param integer $image_id Image to set like
     */
    public function like($image_id)
    {
        // Obtener datos del usuario logueado
        $user = \Auth::user();

        // Comprobar si el like ya existe para no duplicarlo
        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();

        if ($isset_like === 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int) $image_id;

            // Guardar
            $like->save();

            return response()->json(array(
                'status' => 'success',
                'code' => 201,
                'message' => 'Has dado like a la publicación',
                'like' => $like
            ));
        } else {
            return response()->json(array(
                'status' => 'error',
                'code' => 400,
                'message' => 'El like ya existe'
            ));
        }
    }

    public function dislike($image_id)
    {
        // Obtener datos del usuario logueado
        $user = \Auth::user();

        // Comprobar si el like ya existe
        $like = Like::where('user_id', $user->id)->where('image_id', $image_id)->first();

        if ($like) {
            // Eliminar el like
            $like->delete();

            return response()->json(array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Has dado dislike',
                'like' => $like
            ));
        } else {
            return response()->json(array(
                'status' => 'error',
                'code' => 404,
                'message' => 'El like no existe'
            ));
        }
    }
}
