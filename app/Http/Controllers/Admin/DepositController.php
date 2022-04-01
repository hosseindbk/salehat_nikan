<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\acountnumber;
use App\Model\deposit;
use App\Model\Menudashboard;
use App\Model\Reason;
use App\Model\Submenudashboard;
use App\Model\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{

    public function index()
    {
        $deposits  = deposit::leftjoin('users' , 'users.id' ,'=' ,'deposits.user_id')
             ->leftjoin('acountnumbers' , 'acountnumbers.id' ,'=' ,'deposits.acountnumber_id')
             ->leftjoin('reasons' , 'reasons.id' ,'=' ,'deposits.reason_id')
             ->select('deposits.id as id' , 'users.id as userid' , 'deposits.date as date' , 'deposits.amount as amount'
             , 'users.name as name' , 'reasons.title as reason', 'acountnumbers.shomare_card as shomarecard' , 'users.mobile as mobile' , 'deposits.code_number as code')
            ->orderBy('deposits.created_at', 'desc')
            ->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.deposits.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('deposits'));
    }

    public function create()
    {
        $users              = User::select('id' , 'name' , 'melicode' , 'mobile')->where('id' ,'>' ,1)->get();
        $acountnumbers      = acountnumber::select('id' , 'shomare_hesab')->get();
        $reasons            = Reason::select('id' , 'title')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.deposits.create')
            ->with(compact('reasons'))
            ->with(compact('acountnumbers'))
            ->with(compact('users'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(Request $request)
    {

            $code = mt_rand(1000000, 9999999);
            $code = $code . jdate()->format('Ymd');


        $deposits = new deposit();

        $deposits->user_id          = $request->input('user_id');
        $deposits->amount           = str_replace(',' , '' , $request->input('amount'));
        $deposits->date             = $request->input('date');
        $deposits->reason_id        = $request->input('reason_id');
        $deposits->acountnumber_id  = $request->input('acountnumber_id');
        $deposits->code_number      = $code;

        $deposits->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('deposits.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $users              = User::select('id' , 'name')->where('id' ,'>' ,1)->get();

        $deposits           = deposit::leftjoin('users' , 'users.id' ,'=' ,'deposits.user_id')
            ->select('deposits.id as id' ,'deposits.user_id as user_id' , 'deposits.acountnumber_id as acountnumber_id' , 'deposits.date as date' , 'deposits.amount as amount'
                ,'deposits.reason_id as reason' , 'users.name as name' , 'users.phone as phone' , 'deposits.code_number as code')
            ->orderby('deposits.id' , 'DESC')
            ->where('deposits.id' , $id)
            ->get();
        $reasons            = Reason::select('id' , 'title')->get();

        $user_id = deposit::whereId($id)->pluck('user_id');
        $acountnumbers      = acountnumber::select('id' , 'shomare_card')->whereUser_id($user_id)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();


        return view('Admin.deposits.edit')
            ->with(compact('reasons'))
            ->with(compact('acountnumbers'))
            ->with(compact('users'))
            ->with(compact('deposits'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function update(Request $request, $id)
    {
        $deposit = deposit::findOrfail($id);

        $deposit->user_id           = $request->input('user_id');
        $deposit->amount            = str_replace(',' , '' , $request->input('amount'));
        $deposit->date              = $request->input('date');
        $deposit->reason_id         = $request->input('reason_id');
        $deposit->acountnumber_id   = $request->input('acountnumber_id');

        $deposit->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('deposits.index'));
    }

    public function destroy($id)
    {
        $deposits = deposit::findOrfail($id);
        $deposits->delete();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('deposits.index'));
    }
}
