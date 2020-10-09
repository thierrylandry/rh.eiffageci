<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modification extends Model
{
    //
    protected  $table="modification";
    protected $fillable= ['*'];

    public function user(){
        return $this->belongsTo(User::class, "id_users");
    }
    public function type_contrat(){
        return $this->belongsTo(Typecontrat::class,"id_type_contrat","id");
    }
    public function type_contrat_initial(){
        return $this->belongsTo(Typecontrat::class,"id_type_contrat_initial","id");
    }
    public function contrat(){
        return $this->belongsTo(Contrat::class, "id_contrat","id");
    }
    public function entite(){
        return $this->belongsTo(Entite::class, "id","id_entite");
    }
    public function service(){
        return $this->belongsTo(Services::class, "service","id");
    }
    public function personne(){
        return $this->hasOne(Personne::class, "id","id_personne");
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class, "id","id_categorie");
    }
    public function fonction(){
        return $this->hasOne(Fonction::class, "id","id_fonction");
    }
    public function fonction_initial(){
        return $this->belongsTo(Fonction::class,"id_fonction_initial", "id");
    }
}
