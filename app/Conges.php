<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conges extends Model
{
    //
    protected  $table="conges";
    protected $fillable= ['*'];

    public function  personne(){

        return $this->belongsTo('App\Personne', 'id_personne');
    }
}
