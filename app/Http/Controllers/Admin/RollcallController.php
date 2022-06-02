<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Menudashboard;
use App\Model\Rollcall;
use App\Model\Submenudashboard;
use App\Model\Type_user;
use App\Model\User;
use Illuminate\Http\Request;

class RollcallController extends Controller
{
    public function index()
    {
        $users              = User::leftjoin('rollcalls' , 'rollcalls.user_id' , '=', 'users.id')
            ->select('users.id' , 'users.name' , 'rollcalls.entertime' , 'rollcalls.exittime' , 'rollcalls.overtime', 'rollcalls.lowtime')
            ->where('users.level' , 'admin')
            ->where('users.id' ,  '>', 2000)
            ->get();
 
        $typeusers          = Type_user::where('id' , '=' ,  2)->where('id' , '=' ,  5)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.rollcalls.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('typeusers'))
            ->with(compact('users'));
    }

    public function store(Request $request){

//        $entertime = strtotime($request->input('entertime'));
//        $exittime  = strtotime($request->input('exittime'));
        if ($request->input('overtime') != null) {
            $overtime = strtotime($request->input('overtime'));
            $overtimes = date('H:i:s', $overtime);
        } else {
            $overtimes = '00:00:00';
        }
        if ($request->input('lowtime') != null) {
            $lowtime = strtotime($request->input('lowtime'));
            $lowtimes = date('H:i:s', $lowtime);
        }else {
            $lowtimes = '00:00:00';
        }

        $rollcalls = new Rollcall();

        $rollcalls->entertime      = $request->input('entertime');
        $rollcalls->exittime       = $request->input('exittime');
        $rollcalls->overtime       = $overtimes;
        $rollcalls->lowtime        = $lowtimes;
        $rollcalls->user_id        = $request->input('user_id');
        $rollcalls->date           = $request->input('date');
        $rollcalls->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('rollcalls.index'));
    }
}
