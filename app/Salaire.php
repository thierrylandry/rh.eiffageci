<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    //
    protected  $table="salaire";
    protected $fillable= ['id','sursalaire','transport','logement','salissure','tenueTravail','dateDebutS','dateFin','id_contrat','retenue'];
}
