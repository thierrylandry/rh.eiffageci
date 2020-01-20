<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne_presente extends Model
{
    //
    protected  $table="personne_presente";
    protected $fillable= ['*'];
    public function leservice(){

            return $this->belongsTo('App\Services', 'service');
    }
    public function lafonction(){

            return $this->belongsTo('App\Fonction', 'fonction');
    }
    public function lecontrat(){

            return $this->belongsTo('App\Contrat', 'id_contrat');
    }
    public function jours_conges()
    {
        return $this->hasMany(Absconges::class,'id_personne');
    }
}
