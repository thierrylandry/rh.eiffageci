<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $table="users";
    protected $fillable = ['*'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }
    public function service(){
        return $this->belongsTo(Services::class, "id_service",'id');
    }
    public function entite(){
        return $this->belongsTo(Entite::class, "id_entite",'id');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function personne_presente(){
        return $this->belongsTo(Personne_presente::class, "id_personne");
    }
    public function personne(){

        return $this->hasOne('App\Personne','id','id_personne');
    }
    public function chantiers()
    {
        return $this->belongsToMany('App\Entite', 'user_chantier', 'user_id', 'chantier_id');
    }
    public function hasChantier($chantier)
    {
        if ($this->chantiers()->where('libelle', $chantier)->first()) {
            return true;
        }
        return false;
    }
}
