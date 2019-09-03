<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avantages extends Model
{
    //
    protected  $table="avantages";
    protected $fillable= ['*'];

    public function personne(){

        return $this->belongsTo('App\personne','id_personne');
    }
    public function equipement(){

        return $this->belongsTo('App\Equipement','id_equippements');
    }
}
