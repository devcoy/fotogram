<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Http\Response;

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


    public function getImage($filename) {
        $file = \Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }
}
