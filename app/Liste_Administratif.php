<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste_Administratif extends Model
{
    //
    protected  $table="Liste_Administratif";
    protected $fillable= ['id','libelle'];
}
