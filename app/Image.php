<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //Tabla de la BD que estare modificando
    protected $table = 'Images';

    /**
     * Relacion One To Many / Una img puede tener muchos comentario
     * Para obtener todos los comentarios de la image
     * 
     * Indico con que Modelo se va a relacionar
     */
    public function comments() {
        return $this->hasMany('App\Comment');
    }


    /**
     * Relación One To Many / Una img puede tener muchos likes
     * Para obtener todos los likes de la imagen
     * 
     * Indico con que Modelos se va a relacionar
     */
    public function likes() {
        return $this->hasMany('App\Like');
    }

    /**
     * Relacion One To Many (invers) / Muchas imgs pertenecen a un único usuario
     * Para obtener el usurio que ha creado la imagen user_id
     * 
     * Indico con que Modelos se relacionar y la propiedad (atributo) que los relaciona
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

}
