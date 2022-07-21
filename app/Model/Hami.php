<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hami extends Model
{
    public function scopeFilter($query)
    {
        $start_date     = request('start_date');
        if(isset($start_date)  && $start_date != null){
            $query->where('hamis.date' , '>=' , $start_date);
        }

        $end_date       = request('end_date');
        if(isset($end_date)  && $end_date != null){
            $query->where('hamis.date' , '<=' , $end_date);
        }
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
