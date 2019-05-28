<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    //
    protected  $table="fonctions";
    protected $fillable= ['id','libelle'];
}
