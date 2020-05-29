<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne_presente_le_service extends Model
{
    //
    protected  $table="personne_contrat_le_service";
    protected $fillable= ['*'];
    public function leservice(){

        return $this->belongsTo('App\Services', 'id_service');
    }
}
