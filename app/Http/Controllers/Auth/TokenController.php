<?php

namespace App\Http\Controllers\Auth;

use App\Model\ActiveCode;
use App\Http\Controllers\Controller;
use App\Notifications\LoginToWebsite as LoginToWebsiteNotification;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TokenController extends Controller
{
    public function showToken(Request $request)
    {


//        if(! $request->session()->has('auth')) {
//            return redirect(route('loginuser'));
//        }

        $request->session()->reflash();

        return view('Site.auth.token');
    }

    public function token(Request $request)
    {

        $token = $request->input('code');

//        if(! $request->session()->has('auth')) {
//            return redirect(route('loginuser'));
//        }
        $user = User::findOrFail($request->session()->get('auth.user_id'));
        $status = ActiveCode::verifyCode($token , $user);

        if(! $status) {
//            alert()->error('کد صحیح نبود');
            return redirect(route('loginuser'));
        }

        if(auth()->loginUsingId($user->id) && $request->session()->get('auth.reg') == 1) {
            $user->activeCode()->delete();
            $user->phone_verify = 1;
            $user->update();
            return redirect(route('/'));
        } else {
            if (auth()->loginUsingId($user->id)) {
                $user->activeCode()->delete();
                $user->phone_verify = 1;
                $user->update();
                return redirect(route('setpass'));
            }
        }
        return redirect(route('loginuser'));
    }
}
