<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    //
    protected  $table="contrat";
    protected $fillable= ['*'];

    public function  categorie(){

        return $this->belongsTo('App\Categorie', 'id_categorie');
    }
}
