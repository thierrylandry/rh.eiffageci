<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Effectif extends Model
{
    //
    protected  $table="effectif";
    protected $fillable= ['id','nom','effectif'];
}
