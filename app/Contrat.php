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

    public function  nature_contrat(){

        return $this->belongsTo('App\Nature_contrat', 'id_nature_contrat');
    }

    public function  type_contrat(){

        return $this->belongsTo('App\Typecontrat', 'id_type_contrat');
    }
}
