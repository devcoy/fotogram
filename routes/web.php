<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Image;

Route::get('/', function () {
/* $images = Image::all();
foreach($images as $image) {
    //var_dump($images);
    echo $image->image_path . '<br/>';
    echo $image->description . '<hr/>';
    echo $image->user->name . '<br/>';
    echo '<h2>Comentarios</h2>';
    foreach($image->comments as $comment) {
        echo $comment->content . '<br/>';
    }
    echo '<h2>Likes</h2>';
    echo count($image->likes) . '<br/>';
    echo '<hr/>'; 
}
die(); */

    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/configuracion', 'UserController@config')->name('config');

Route::post('/user/actualizar', 'UserController@update')->name('user.update');

Route::get('/user/imagen/{filename}', 'UserController@getImage')->name('user.image');
