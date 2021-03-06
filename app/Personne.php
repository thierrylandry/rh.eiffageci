<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    //
    protected  $table="personne";
    protected $fillable= ['id','nom','prenom','datenaissance','sexe','nationalite','matrimonial','enfant','cnps','pointure','id_entite','id_unite','id_createur','id_modificateur','contact','email','image','situationmat','slug','surete','matricule','service','adresse','whatsapp','sattelitaire','presenceEff','id_commune','lieu_naissance','noms_pere','noms_mere'];


    public function societe(){
        return $this->belongsTo(Societe::class, "id_unite");
    }

    public function entite(){
        return $this->belongsTo(Entite::class, "id_entite");
    }

    public function contrat_renouvelles(){
        return $this->hasMany(Contrat::class, "matricule","matricule");
    }
    public function jours_conges()
    {
        return $this->hasMany(Conges::class,'id_personne');
    }
    public function contrat()
    {
        return $this->hasMany(Contrat::class,'id_personne');
    }

    public function pays(){
        return $this->belongsTo(Pays::class, "nationalite");
    }
    public function commune(){
        return $this->belongsTo(Commune::class, "id_commune");
    }

    public function fonction(){
        return $this->belongsTo('App\Fonction', "fonction","id");
    }
    public function lafonction(){
        return $this->belongsTo('App\Fonction', "fonction","id");
    }
    public function getEntiteString(){
        if($this->id_entite==1){
            return "PHB";
        }elseif($this->id_entite==2){
            return "SPIE FONDATION";
        }elseif($this->id_entite==3){
            return "DIRECTION CI";
        }
    }
}
