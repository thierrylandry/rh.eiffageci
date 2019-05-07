<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    //
    protected  $table="pays";
    protected $fillable= ['id','code','alpha2','alpha3','nom_en_gb','nom_fr_fr'];
}
