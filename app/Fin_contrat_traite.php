<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fin_contrat_traite extends Model
{
    //
    protected $table="fin_contrat_traite";
    protected $fillable= ['*'];
    public function personne(){
        return $this->belongsTo(Personne::class, "id_personne");
    }
    public function services(){
        return $this->belongsTo(Services::class, "id_service");
    }
}
