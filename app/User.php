<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username' ,'phone' , 'phone_number','api_token' , 'address' , 'state_id' , 'type_id' , 'city_id' , 'image' ,'whatsapp' ,'instagram', 'telegram' , 'email', 'password',
    ];
    public function activeCode()
    {
        return $this->hasMany(ActiveCode::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin()
    {
        return $this->level == 'admin' ? true : false;
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function hasRole($role)
    {
        if(is_string($role)) {
            return $this->roles->contains('name' , $role);
        }
        return !! $role->intersect($this->roles)->count();
    }
    public function comment(){
        return $this->hasMany(comment::class);
    }

    public function commentrate(){
        return $this->hasMany(comment::class);
    }
}
