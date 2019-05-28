<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    //
    protected  $table="definition";
    protected $fillable= ['id','libelle'];
}
