<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    //
    protected  $table="personne";
    protected $fillable= ['id','nom','prenom','datenaissance','sexe','nationalite','matrimonial','enfant','cnps','pointure','entite','id_societe','id_createur','id_modificateur','contact','email','image','situationmat','slug'];
}
