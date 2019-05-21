<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    //
    protected  $table="contrat";
    protected $fillable= ['id','matricule','datedebutc','datefinc','couvertureMaladie','ruptureEssaie','departDefiniti','id_type_contrat','	id_personne','id_service'];
}
