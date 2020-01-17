<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absconges extends Model
{
    //
    protected $table="absconges";
    protected $fillable= ['*'];
    public function  personne(){

        return $this->belongsTo('App\Personne', 'id_personne');
    }
    public function user(){
        return $this->belongsTo(User::class, "id_users");
    }
    public function Type_conge(){
        return $this->belongsTo(Type_conges::class, "id_motif_demande");
    }
}
