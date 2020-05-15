<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    /**
     * 
     * @return view
     */
    public function config() {
        return view('user.config');
    }
}
