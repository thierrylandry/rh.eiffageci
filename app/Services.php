<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    //
    protected  $table="services";
    protected $fillable= ['id','libelle'];

    public function Liste_fin_contrat_traite(){
        return $this->hasMany(Fin_contrat_traite::class, "id","id_service");
    }
}
