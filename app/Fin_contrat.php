<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fin_contrat extends Model
{
    //



    protected  $table="fin_contrat";
    protected $fillable= ['nom','prenom','libelle','datefinc','datedebutc'];
}
