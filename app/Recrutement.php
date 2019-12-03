<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recrutement extends Model
{
    //
    protected  $table="recrutement";
    protected $fillable= ['*'];

    public function user(){
        return $this->belongsTo(User::class, "id_users");
    }
    public function type_contrat(){
        return $this->belongsTo(Typecontrat::class, "id_type_contrat");
    }
    public function entite(){
        return $this->belongsTo(Entite::class, "id_entite");
    }
    public function service(){
        return $this->belongsTo(Services::class, "id_service");
    }
    public function unitejour(){
        return $this->belongsTo(uniteJour::class, "id_uniteJour");
    }
}
