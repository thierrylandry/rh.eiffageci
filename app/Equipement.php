<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    //
    protected $table="equipements";
    protected $fillable= ['*'];

    public function  type_equipement(){

        return $this->belongsTo('App\Type_equipement', 'id_type_equipement');
    }
}
