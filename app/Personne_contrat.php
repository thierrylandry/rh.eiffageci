<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne_contrat extends Model
{
    //
    protected  $table="personne_contrat";
    protected $fillable= ['nom','prenom','libelle','datefinc'];
}
