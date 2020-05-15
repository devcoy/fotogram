<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'Likes';

    /**
     * Relacion One To Many (invers) / Muchos likes pertenecen a un único usuario
     * Para obtener el usurio que ha creado el like user_id
     * 
     * Indico con que Modelos se relacionar y la propiedad (atributo) que los relaciona
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Relacion One To Many (invers) / Muchas likes pertenecen a una img 
     * Para obtener la img a la pertenece el like image_id
     * 
     * Indico con que Modelos se relacionar y la propiedad (atributo) que los relaciona
     */
    public function image() {
        return $this->belongsTo('App\Image', 'image_id');
    }
}
