<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    //
    protected  $table="invite";
    protected $fillable= ['*'];

    public function passages()
    {
        return $this->hasMany('App\Passage','id_invite');
    }
}
