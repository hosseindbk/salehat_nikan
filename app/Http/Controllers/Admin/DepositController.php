<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\acountnumber;
use App\Model\deposit;
use App\Model\Hami;
use App\Model\Menudashboard;
use App\Model\Reason;
use App\Model\Submenudashboard;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{

    public function index()
    {
        if (auth::user()->id == 1 || auth::user()->id == 2000 || auth::user()->id == 2006) {
            $deposits = deposit::leftjoin('users', 'users.id', '=', 'deposits.hamahang_id')
                ->leftjoin('hamis', 'hamis.id', '=', 'deposits.user_id')
                ->leftjoin('acountnumbers', 'acountnumbers.id', '=', 'deposits.acountnumber_id')
                ->leftjoin('reasons', 'reasons.id', '=', 'deposits.reason_id')
                ->select('deposits.id as id', 'hamis.id as userid', 'deposits.date as date', 'deposits.amount as amount'
                    , 'hamis.name as name', 'reasons.title as reason', 'users.name as hamahangname' ,  'acountnumbers.shomare_hesab as shomare_hesab'
                    , 'hamis.mobile as mobile', 'deposits.code_number as code')
                ->orderBy('deposits.created_at', 'desc')
                ->get();
        }else{
        $deposits = deposit::leftjoin('users', 'users.id', '=', 'deposits.user_id')
            ->leftjoin('hamis', 'hamis.id', '=', 'deposits.user_id')
            ->leftjoin('acountnumbers', 'acountnumbers.id', '=', 'deposits.acountnumber_id')
            ->leftjoin('reasons', 'reasons.id', '=', 'deposits.reason_id')
            ->select('deposits.id as id', 'hamis.id as userid', 'deposits.date as date', 'deposits.amount as amount'
                , 'hamis.name as name', 'reasons.title as reason', 'acountnumbers.shomare_card as shomarecard', 'hamis.mobile as mobile', 'deposits.code_number as code')
            ->orderBy('deposits.created_at', 'desc')
            ->where('deposits.hamahang_id' , '=' , auth::user()->id )
            ->get();
    }
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.deposits.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('deposits'));
    }

    public function create()
    {
        $hamis              = Hami::leftjoin('users' , 'users.id' , '=' ,'hamis.hamahang_id' )->select('hamis.id' , 'hamis.name'  , 'hamis.mobile' , 'users.name as username')->get();
        $userhamahang       = User::select('id' , 'name')->whereType_id(2)->get();
        $acountnumbers      = acountnumber::select('id' , 'shomare_hesab' , 'title')->get();
        $reasons            = Reason::select('id' , 'title')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.deposits.create')
            ->with(compact('userhamahang'))
            ->with(compact('reasons'))
            ->with(compact('acountnumbers'))
            ->with(compact('hamis'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(Request $request)
    {

            $code = mt_rand(1000000, 9999999);
            $code = $code . jdate()->format('Ymd');


        $deposits = new deposit();

        $deposits->user_id          = $request->input('hami_id');
        $deposits->amount           = str_replace(',' , '' , $request->input('amount'));
        $deposits->date             = $request->input('date');
        $deposits->reason_id        = $request->input('reason_id');
        $deposits->hamahang_id      = $request->input('hamahang_id');
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
            ->leftjoin('acountnumbers' , 'acountnumbers.id' , '=' , 'deposits.acountnumber_id' )
            ->select('deposits.id as id' ,'deposits.user_id as user_id' , 'acountnumbers.title as hesabtitle' , 'acountnumbers.shomare_hesab' , 'deposits.acountnumber_id as acountnumber_id' , 'deposits.date as date' , 'deposits.amount as amount'
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
