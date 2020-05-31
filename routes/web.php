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


//Ruta de imágenes
Route::get('/publicacion/crear', 'ImageController@create')->name('image.create');
Route::post('/publicacion/guardar', 'ImageController@save')->name('image.save');
Route::get('/imagen/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/imagen/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/publicacion/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/publicacion/actualizar', 'ImageController@update')->name('image.update');


// Rutas Comentarios
Route::post('/comentario/comentar', 'CommentController@save')->name('comment.save');
Route::get('/comentario/eliminar/{id}', 'CommentController@delete')->name('comment.delete');

// Rutas Likes
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/likes', 'LikeController@index')->name('like.index');


// Rutas de usuarios
Route::get('/usuarios/{search?}', 'UserController@index')->name('user.index');
Route::get('/perfil/{id}', 'UserController@profile')->name('user.profile');
Route::get('/usuario/configuracion', 'UserController@config')->name('config');
Route::post('/usuario/actualizar', 'UserController@update')->name('user.update');
Route::get('/usuario/imagen/{filename}', 'UserController@getImage')->name('user.image');