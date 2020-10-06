<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
    protected  $table="absence";
    protected $fillable= ['*'];

    public function valideur(){
        return $this->belongsTo(User::class, "id_valideur");
    }
    public function user(){
        return $this->belongsTo(User::class, "id_users");
    }
    public function type_permission(){
        return $this->belongsTo(Type_permission::class, "id_type_permission");
    }
    public function personne(){
        return $this->belongsTo(Personne::class, "id_personne");
    }
}
