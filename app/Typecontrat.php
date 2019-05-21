<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typecontrat extends Model
{
    //
    protected  $table="typecontrat";
    protected $fillable= ['id','libelle'];
}
