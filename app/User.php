<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','prenoms',"date2naissance","photo","contact1","contact2","perfect_money",'role','is_locked',"residence", 'email', 'password','lien_parainage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //get user adhesion informations
    public function adhesion()
    {
      return $this->hasOne("App\Models\Adhesion","user");
    }

    //get user residence informations
    public function residence()
    {
      return $this->belongsTo("App\Models\Residence","residence","id");
    }

    //get user don
    public function dons()
    {
      return $this->hasMany("App\Models\Don","user");
    }

    //get user rsd
    public function rsds()
    {
      return $this->hasMany("App\Models\Rsd","user");
    }

    //get user rsd
    public function gains()
    {
      return $this->hasMany("App\Models\Gain","master");
    }

    //get user actions
    public function logs()
    {
      return $this->hasMany('App\Models\Log','user');
    }
}
