<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'Comments';

    /**
     * Relacion One To Many (invers) / Muchos comentarios pertenecen a un único usuario
     * Para obtener el usurio que ha creado el comentario user_id
     * 
     * Indico con que Modelos se relacionar y la propiedad (atributo) que los relaciona
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Relacion One To Many (invers) / Muchos comentarios pertenecen a una única img
     * Para obtener la img a la pertenece el comentario image_id
     * 
     * Indico con que Modelos se relacionar y la propiedad (atributo) que los relaciona
     */
    public function image() {
        return $this->belongsTo('App\Image', 'image_id');
    }
}
