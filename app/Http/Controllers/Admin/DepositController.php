<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\depositrequest;
use App\Model\acountnumber;
use App\Model\deposit;
use App\Model\Hami;
use App\Model\Menudashboard;
use App\Model\Reason;
use App\Model\Submenudashboard;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DepositController extends Controller
{

    public function index(Request $request)
    {
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        if ($request->ajax()) {

             if (auth::user()->id == 1 || auth::user()->id == 2000 || auth::user()->id == 2006) {
                     $page      = (!empty($_GET["page"]))   ? ($_GET["page"])   : (10);
                     $data = deposit::leftjoin('users', 'users.id', '=', 'deposits.hamahang_id')
                         ->leftjoin('hamis', 'hamis.id', '=', 'deposits.user_id')
                         ->leftjoin('acountnumbers', 'acountnumbers.id', '=', 'deposits.acountnumber_id')
                         ->leftjoin('reasons', 'reasons.id', '=', 'deposits.reason_id')
                         ->select(
                               'hamis.name as name'
                             , 'users.name as hamahangname'
                             , 'hamis.id as userid'
                             , 'deposits.hamiyab as hamiyab'
                             , 'deposits.id as id'
                             , 'deposits.date as date'
                             , 'deposits.amount as amount'
                             , 'deposits.code_number as code'
                             , 'reasons.title as reason'
                             , 'deposits.description as description'
                             , 'acountnumbers.shomare_hesab as shomare_hesab'
                             , 'acountnumbers.title as hesabtitle'
                             , 'hamis.mobile as mobile','hamis.mobile2 as mobile2')

                         ->orderBy('deposits.created_at', 'desc')
                         ->filter()
                         ->take($page)
                         ->get();

                //dd($data);
                return Datatables::of($data)
                    ->addColumn('userid', function ($data) {
                        return ($data->userid);
                    })
                    ->addColumn('name', function ($data) {
                        return ($data->name);
                    })
                    ->addColumn('mobile', function ($data) {
                        return ($data->mobile);
                    })
                    ->addColumn('mobile2', function ($data) {
                        return ($data->mobile2);
                    })
                    ->addColumn('date', function ($data) {
                        return ($data->date);
                    })
                    ->addColumn('amount', function ($data) {
                        return (number_format($data->amount));
                    })
                    ->addColumn('reason', function ($data) {
                        return ($data->reason);
                    })
                    ->addColumn('hesabtitle', function ($data) {
                        return ($data->hesabtitle);
                    })
                    ->addColumn('code', function ($data) {
                        return ($data->code);
                    })
                    ->addColumn('hamahangname', function ($data) {
                        return ($data->hamahangname);
                    })
                    ->addColumn('hamiyab', function ($data) {
                        return ($data->hamiyab);
                    })
                    ->addColumn('description', function ($data) {
                        return ($data->description);
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="' . route('deposits.edit', $row->id) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                  <form action="' . route('deposits.destroy', $row->id) . '" method="post" style="display:inline">
                                    ' . csrf_field() . '
                                    ' . method_field("DELETE") . '
                                         <button type="submit" class="btn ripple btn-outline-danger btn-sm">
                                             <i class="fe fe-trash-2 "></i>
                                         </button>
                                </form>';

                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } else {
                     $page = (!empty($_GET["page"]))   ? ($_GET["page"])   : (10);

                     $data = deposit::leftjoin('users', 'users.id', '=', 'deposits.user_id')
                         ->leftjoin('hamis', 'hamis.id', '=', 'deposits.user_id')
                         ->leftjoin('acountnumbers', 'acountnumbers.id', '=', 'deposits.acountnumber_id')
                         ->leftjoin('reasons', 'reasons.id', '=', 'deposits.reason_id')
                         ->select(
                             'hamis.name as name'
                             , 'users.name as hamahangname'
                             , 'hamis.id as userid'
                             , 'deposits.hamiyab as hamiyab'
                             , 'deposits.id as id'
                             , 'deposits.date as date'
                             , 'deposits.amount as amount'
                             , 'deposits.code_number as code'
                             , 'reasons.title as reason'
                             , 'deposits.description as description'
                             , 'acountnumbers.shomare_hesab as shomare_hesab'
                             , 'acountnumbers.title as hesabtitle'
                             , 'hamis.mobile as mobile','hamis.mobile2 as mobile2')
                         ->orderBy('deposits.created_at', 'desc')
                         ->filter()
                         ->where('deposits.hamahang_id', '=', auth::user()->id)
                         ->take($page)
                         ->get();

                return Datatables::of($data)
                    ->addColumn('id', function ($data) {
                        return ($data->id);
                    })
                    ->addColumn('name', function ($data) {
                        return ($data->name);
                    })
                    ->addColumn('mobile', function ($data) {
                        return ($data->mobile);
                    })
                    ->addColumn('mobile2', function ($data) {
                        return ($data->mobile2);
                    })
                    ->addColumn('date', function ($data) {
                        return ($data->date);
                    })
                    ->addColumn('amount', function ($data) {
                        return ($data->amount);
                    })
                    ->addColumn('reason', function ($data) {
                        return ($data->amount);
                    })
                    ->addColumn('hesabtitle', function ($data) {
                        return ($data->hesabtitle);
                    })
                    ->addColumn('code', function ($data) {
                        return ($data->code);
                    })
                    ->addColumn('hamahangname', function ($data) {
                        return ($data->hamahangname);
                    })
                    ->addColumn('hamiyab', function ($data) {
                        return ($data->hamiyab);
                    })
                    ->addColumn('description', function ($data) {
                        return ($data->description);
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="' . route('deposits.edit', $row->id) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                  <form action="' . route('deposits.destroy', $row->id) . '" method="post" style="display:inline">
                                    ' . csrf_field() . '
                                    ' . method_field("DELETE") . '
                                         <button type="submit" class="btn ripple btn-outline-danger btn-sm">
                                             <i class="fe fe-trash-2 "></i>
                                         </button>
                                </form>';

                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }

        return view('Admin.deposits.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
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

    public function store(depositrequest $request)
    {

        $code = mt_rand(1000000, 9999999);
        $code = $code . jdate()->format('Ymd');


        $hami_id                = Hami::select('id')->whereId($request->input('hami_id'))->get();
        $countdeposit           = Hami::whereId($request->input('hami_id'))->pluck('countdeposit');
        $hamis                  = Hami::findOrfail($hami_id)->first();
        $hamis->countdeposit    = $countdeposit[0]+1;
        $hamis->save();

        $hamiyab_id             = Hami::whereId($request->input('hami_id'))->pluck('hamahang_id');
        $hamiyab_names          = User::whereId($hamiyab_id[0])->pluck('name');

        $deposits = new deposit();

        $deposits->user_id          = $request->input('hami_id');
        $deposits->amount           = str_replace(',' , '' , $request->input('amount'));
        $deposits->date             = $request->input('date');
        $deposits->hamiyab          = $hamiyab_names[0];
        $deposits->reason_id        = $request->input('reason_id');
        $deposits->hamahang_id      = $request->input('hamahang_id');
        $deposits->acountnumber_id  = $request->input('acountnumber_id');
        $deposits->description      = $request->input('description');
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
        $users    = User::select('id' , 'name')->where('id' ,'>' ,1)->get();
        $hamis    = Hami::select('id' , 'name')->get();
        $deposits = deposit::leftjoin('hamis' , 'hamis.id' ,'=' ,'deposits.user_id')
                        ->leftjoin('acountnumbers' , 'acountnumbers.id' , '=' , 'deposits.acountnumber_id' )
                        ->select('deposits.id as id' ,'deposits.hamahang_id as hamahang_id' , 'deposits.user_id as user_id' , 'acountnumbers.title as hesabtitle' , 'deposits.code_number as code'
                            , 'acountnumbers.shomare_hesab' , 'deposits.acountnumber_id as acountnumber_id' , 'deposits.date as date' , 'deposits.amount as amount'
                            ,'deposits.description as description','deposits.reason_id as reason' , 'hamis.name as name', 'hamis.id as hamisid' , 'hamis.mobile as mobile')
                        ->orderby('deposits.id' , 'DESC')
                        ->where('deposits.id' , $id)
                        ->get();

        $reasons            = Reason::select('id' , 'title')->get();
        $userhamahang       = User::select('id' , 'name')->whereType_id(2)->get();
        $acountnumbers      = acountnumber::select('id' , 'shomare_hesab' , 'title')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();


        return view('Admin.deposits.edit')
            ->with(compact('hamis'))
            ->with(compact('reasons'))
            ->with(compact('acountnumbers'))
            ->with(compact('userhamahang'))
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
        $deposit->hamahang_id       = $request->input('hamahang_id');
        $deposit->description       = $request->input('description');
        $deposit->acountnumber_id   = $request->input('acountnumber_id');

        $deposit->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('deposits.index'));
    }

    public function destroy($id)
    {
        $deposit = deposit::whereId($id)->pluck('user_id');
        $hami_id                = Hami::select('id')->whereId($deposit[0])->get();
        $countdeposit           = Hami::whereId($deposit[0])->pluck('countdeposit');
        $hamis                  = Hami::findOrfail($hami_id)->first();
        $hamis->countdeposit    = $countdeposit[0] - 1;
        $hamis->save();

        $deposits = deposit::findOrfail($id);
        $deposits->delete();



        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('deposits.index'));
    }
}
