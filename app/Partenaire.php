<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    //
    protected  $table="partenaire";
    protected $fillable= ['id','nom','effectif'];
}
