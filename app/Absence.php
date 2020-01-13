<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
    protected  $table="absence";
    protected $fillable= ['*'];

    public function user(){
        return $this->belongsTo(User::class, "id_users");
    }
    public function personne(){
        return $this->belongsTo(Personne::class, "id_personne");
    }
}
