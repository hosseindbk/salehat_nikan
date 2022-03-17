<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\acountnumber;
use App\Model\deposit;
use App\Model\Menudashboard;
use App\Model\Submenudashboard;
use App\Model\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{

    public function index()
    {
        $deposits           = deposit::leftjoin('users' , 'users.id' ,'=' ,'deposits.user_id')
                                     ->leftjoin('acountnumbers' , 'acountnumbers.id' ,'=' ,'deposits.acountnumber_id')
                                        ->select('deposits.id as id' , 'deposits.created_at as date' , 'deposits.amount as amount'
                                        ,'deposits.reason as reason' , 'users.name as name', 'acountnumbers.shomare_hesab as shomarehesab' , 'users.mobile as mobile' , 'deposits.code_number as code')
            ->orderby('deposits.id' , 'DESC')
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
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.deposits.create')
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
        $deposits->amount           = $request->input('amount');
        $deposits->reason           = $request->input('reason');
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
            ->select('deposits.id as id' ,'deposits.user_id as user_id' , 'deposits.created_at as date' , 'deposits.amount as amount'
                ,'deposits.reason as reason' , 'users.name as name' , 'users.phone as phone' , 'deposits.code_number as code')
            ->orderby('deposits.id' , 'DESC')
            ->where('deposits.id' , $id)
            ->get();
        $user_id = deposit::whereId($id)->pluck('user_id');
        $acountnumbers      = acountnumber::select('id' , 'shomare_hesab')->whereUser_id($user_id)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();


        return view('Admin.deposits.edit')
            ->with(compact('acountnumbers'))
            ->with(compact('users'))
            ->with(compact('deposits'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function update(Request $request, $id)
    {
        $deposit = deposit::findOrfail($id);

        $deposit->user_id      = $request->input('user_id');
        $deposit->amount       = $request->input('amount');
        $deposit->reason       = $request->input('reason');
        $deposit->acountnumber_id  = $request->input('acountnumber_id');

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
