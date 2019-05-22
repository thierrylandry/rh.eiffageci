<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    protected  $table="unite";
    protected $fillable= ['id','libellesoc'];
}
