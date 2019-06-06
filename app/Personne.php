<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    //
    protected  $table="personne";
    protected $fillable= ['id','nom','prenom','datenaissance','sexe','nationalite','matrimonial','enfant','cnps','pointure','entite','id_societe','id_createur','id_modificateur','contact','email','image','situationmat','slug','surete'];


    public function societe(){
        return $this->belongsTo(Societe::class, "id_societe");
    }

    public function pays(){
        return $this->belongsTo(Pays::class, "nationalite");
    }

    public function fonction(){
        return $this->belongsTo(Fonction::class, "fonction");
    }

    public function getEntiteString(){
        if($this->entite==1){
            return "PHB";
        }else{
            return "DIRECTION CI";
        }
    }
}
