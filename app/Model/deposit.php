<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class deposit extends Model
{
    public function scopeFilter($query)
    {
//        $start_date    = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
//        $end_date      = (!empty($_GET["end_date"]))   ? ($_GET["end_date"])   : ('');
//        $user_id       = (!empty($_GET["user_id"]))    ? ($_GET["user_id"])    : ('');
//        $name          = (!empty($_GET["name"]))       ? ($_GET["name"])       : ('');
//        $mobile        = (!empty($_GET["mobile"]))     ? ($_GET["mobile"])     : ('');
//        $reason        = (!empty($_GET["reason"]))     ? ($_GET["reason"])     : ('');
//        $hesab         = (!empty($_GET["hesab"]))      ? ($_GET["hesab"])      : ('');
//        $hamahang      = (!empty($_GET["hamahang"]))   ? ($_GET["hamahang"])   : ('');

        $start_date     = request('start_date');
        if(isset($start_date)  && $start_date != null){
            $query->where('deposits.date' , '>=' , $start_date);
        }

        $end_date       = request('end_date');
        if(isset($end_date)  && $end_date != null){
            $query->where('deposits.date' , '<=' , $end_date);
        }

        $user_id       = request('user_id');
        if(isset($user_id)  && $user_id != null){
            $query->where('hamis.id' , '=' , $user_id);
        }

        $name       = request('name');
        if(isset($name)  && $name != null){
            $query->where('hamis.name', 'like', '%' . $name . '%' );
        }

        $mobile       = request('mobile');
        if(isset($mobile)  && $mobile != null){
            $query->where('hamis.mobile' , '=' , $mobile)->orwhere('hamis.mobile2' , '=' , $mobile);
        }

        $reason       = request('reason');
        if(isset($reason)  && $reason != null){
            $query->where('reasons.title', 'like', '%' . $reason . '%' );
        }

        $hesab       = request('hesab');
        if(isset($hesab)  && $hesab != null){
            $query->where('acountnumbers.title', 'like', '%' . $hesab . '%' );
        }

        $hamahang       = request('hamahang');
        if(isset($hamahang)  && $hamahang != null){
            $query->where('users.name', 'like', '%' . $hamahang . '%' );
        }

    }
}
