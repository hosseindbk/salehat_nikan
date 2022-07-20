<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hami extends Model
{
    public function scopeFilter($query)
    {
        $user_id       = request('user_id');
        if(isset($user_id)  && $user_id != null){
            $query->where('hamis.id', $user_id );
        }
        $name       = request('name');
        if(isset($name)  && $name != null){
            $query->where('hamis.name', 'like', '%' . $name . '%' );
        }
        $mobile       = request('mobile');
        if(isset($mobile)  && $mobile != null){
            $query->where('hamis.mobile' , '=' , $mobile)->orwhere('hamis.mobile2' , '=' , $mobile);
        }
        $total       = request('total');
        if(isset($total)  && $total != null){
            $query->where('hamis.countdeposit' , '=' , $total);
        }
        $hamiyab       = request('hamiyab');
        if(isset($hamiyab)  && $hamiyab != null){
            $query->where('users.name', 'like', '%' . $hamiyab . '%' );
        }
    }
}
