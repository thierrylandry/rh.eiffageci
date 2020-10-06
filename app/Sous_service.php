<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sous_service extends Model
{
    //
    protected $table="sous_services";
    protected $fillable= ['*'];
    public function  role(){

        return $this->hasOne('App\Role','id_sous_service');
    }

}
