<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected  $table="roles";
    protected $fillable= ['id','name','description'];
    public function  sous_service(){

        return $this->belongsTo('App\Sous_service', 'id_sous_service');
    }
}
