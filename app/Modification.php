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
        return $this->belongsTo(Typecontrat::class, "id","id_type_contrat");
    }
    public function contrat(){
        return $this->belongsTo(Contrat::class, "id","id_contrat");
    }
    public function entite(){
        return $this->belongsTo(Entite::class, "id","id_entite");
    }
    public function service(){
        return $this->belongsTo(Services::class, "id","id_service");
    }
    public function personne(){
        return $this->hasOne(Personne::class, "id","id_personne");
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class, "id","id_categorie");
    }
    public function fonction(){
        return $this->belongsTo(Fonction::class, "id","id_fonction");
    }
}
