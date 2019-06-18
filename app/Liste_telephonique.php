<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste_telephonique extends Model
{
    //
    protected  $table="liste_telephonique";
    protected $fillable= ['id','nom','prenom','fonction','contact','email'];
}
