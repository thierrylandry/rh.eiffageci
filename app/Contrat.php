<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    //
    protected $table = "contrat";
    protected $fillable = ['*'];

    public function categorie()
    {

        return $this->belongsTo('App\Categorie', 'id_categorie');
    }
    public function modification()
    {

        return $this->belongsTo('App\Modification', 'id_modification');
    }

    public function nature_contrat()
    {

        return $this->belongsTo('App\Nature_contrat', 'id_nature_contrat');
    }

    public function type_contrat()
    {

        return $this->belongsTo('App\Typecontrat', 'id_type_contrat');
    }
    public function personne()
    {
        return $this->hasOne('App\Personne','id', 'id_personne');
    }
    public function commune()
    {

        return $this->hasOne('App\Commune','id', 'id_commune');
    }
    public function definition()
    {

        return $this->hasOne('App\Definition','id', 'id_definition');
    }
    public function service()
    {

        return $this->belongsTo('App\Services','id_service','id');
    }

}