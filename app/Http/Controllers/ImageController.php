<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    // Restringir el acceso usando un middleware a nivel controlador
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Subir imagen
     */
    public function create() {
        return view('image.create');
    }
}
