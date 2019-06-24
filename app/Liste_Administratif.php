<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste_Administratif extends Model
{
    //
    protected  $table="liste_administratif";
    protected $fillable= ['id','libelle'];
}
