<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passage extends Model
{
    //
    protected  $table="passage";
    protected $fillable= ['id','dateArrive','dateDepart','id_invite'];
    public function invite()
    {
        return $this->belongsTo('App\Invite');
    }
}
