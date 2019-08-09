<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    //
    protected  $table="personne";
    protected $fillable= ['id','nom','prenom','datenaissance','sexe','nationalite','matrimonial','enfant','cnps','pointure','entite','id_unite','id_createur','id_modificateur','contact','email','image','situationmat','slug','surete','matricule','service'];


    public function societe(){
        return $this->belongsTo(Societe::class, "id_unite");
    }

    public function contrat_renouvelles(){
        return $this->hasMany(Contrat::class, "matricule","matricule");
    }
    public function jours_conges()
    {
        return $this->hasMany(Conges::class,'id_personne');
    }

    public function pays(){
        return $this->belongsTo(Pays::class, "nationalite");
    }

    public function fonction(){
        return $this->belongsTo('App\Fonction', "fonction");
    }

    public function getEntiteString(){
        if($this->entite==1){
            return "PHB";
        }elseif($this->entite==2){
            return "SPIE FONDATION";
        }elseif($this->entite==3){
            return "DIRECTION CI";
        }
    }
}
