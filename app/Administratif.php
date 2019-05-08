<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administratif extends Model
{
    //
    protected  $table="administratif";
    protected $fillable= ['id','type_doc','existance','pj','id_personne'];
}
