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
        return $this->belongsTo(Typecontrat::class, "id_type_contrat");
    }
    public function contrat(){
        return $this->belongsTo(Contrat::class, "id_contrat");
    }
    public function entite(){
        return $this->belongsTo(Entite::class, "id_entite");
    }
    public function service(){
        return $this->belongsTo(Services::class, "id_service");
    }
    public function personne(){
        return $this->belongsTo(Personne::class, "id_personne");
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class, "id_categorie");
    }
    public function fonction(){
        return $this->belongsTo(Fonction::class, "id_fonction");
    }
}
