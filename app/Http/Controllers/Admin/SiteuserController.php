<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hamirequest;
use App\Model\acountnumber;
use App\Model\Bank;
use App\Model\Hami;
use App\Model\Menudashboard;
use App\Model\Submenudashboard;
use App\Model\Type_user;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SiteuserController extends Controller
{

    public function index(Request $request)
    {
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        $startdate  =   $request->startdate;
        $enddate    =   $request->enddate;
        if($request->page)
            $page = $request->page;
        else
            $page = 25;
        if ($request->ajax()) {

            if (auth::user()->id == 1 || auth::user()->id == 2000 || auth::user()->id == 2006) {

                $data = Hami::leftjoin('users', 'users.id', '=', 'hamis.hamahang_id')
                    ->select('hamis.id', 'hamis.name', 'hamis.mobile', 'hamis.date', 'users.name as username', 'hamis.phone_verify', 'hamis.status')
                    ->orderBy('id' , 'DESC')
                    ->get();

                return Datatables::of($data)
                    ->editColumn('id', function ($data) {
                        return ($data->id);
                    })
                    ->editColumn('name', function ($data) {
                        return ($data->name);
                    })
                    ->editColumn('mobile', function ($data) {
                        return ($data->mobile);
                    })
                    ->editColumn('date', function ($data) {
                        return ($data->date);
                    })
                    ->editColumn('username', function ($data) {
                        return ($data->username);
                    })
                    ->editColumn('phone_verify', function ($data) {
                        if ($data->phone_verify == "0") {
                            return 'تایید نشده';
                        } elseif ($data->phone_verify == "1") {
                            return 'فعال';
                        }
                    })
                    ->editColumn('status', function ($data) {
                        if ($data->status == "1") {
                            return 'ثبت نام اولیه';
                        } elseif ($data->status == "2") {
                            return 'فعال';
                        } elseif ($data->status == "3") {
                            return 'غیر فعال';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="' . route('siteusers.edit', $row->id) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                  <form action="' . route('siteusers.destroy', $row->id) . '" method="post" style="display:inline">
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
            }else{
                $data = Hami::leftjoin('users', 'users.id', '=', 'hamis.hamahang_id')->
                    select('hamis.id', 'hamis.name', 'hamis.mobile', 'hamis.date', 'users.name as username', 'hamis.phone_verify', 'hamis.status')
                    ->where('hamis.hamahang_id', '=', Auth::user()->id)
                    ->get();

                return Datatables::of($data)
                    ->editColumn('id', function ($data) {
                        return ($data->id);
                    })
                    ->editColumn('name', function ($data) {
                        return ($data->name);
                    })
                    ->editColumn('mobile', function ($data) {
                        return ($data->mobile);
                    })
                    ->editColumn('date', function ($data) {
                        return ($data->date);
                    })
                    ->editColumn('username', function ($data) {
                        return ($data->username);
                    })
                    ->editColumn('phone_verify', function ($data) {
                        if ($data->phone_verify == "0") {
                            return 'تایید نشده';
                        } elseif ($data->phone_verify == "1") {
                            return 'فعال';
                        }
                    })
                    ->editColumn('status', function ($data) {
                        if ($data->status == "1") {
                            return 'ثبت نام اولیه';
                        } elseif ($data->status == "2") {
                            return 'فعال';
                        } elseif ($data->status == "3") {
                            return 'غیر فعال';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="' . route('siteusers.edit', $row->id) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                  <form action="' . route('siteusers.destroy', $row->id) . '" method="post" style="display:inline">
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

        return view('Admin.siteusers.all')
            ->with(compact('startdate'))
            ->with(compact('enddate'))
            ->with(compact('page'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }
    public function create()
    {
        $typeusers          = Type_user::where('id' , 3)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        $userhamahang       = User::select('id' , 'name')->whereType_id(2)->get();
        $userjazb           = User::select('id' , 'name')->whereType_id(4)->get();
        return view('Admin.siteusers.create')
            ->with(compact('userhamahang'))
            ->with(compact('userjazb'))
            ->with(compact('typeusers'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(Hamirequest $request)
    {

        $hamis = new Hami();

        $hamis->name            = $request->input('name');
        $hamis->date            = $request->input('date');
        $hamis->hamahang_id     = $request->input('hamahang_id');
        $hamis->mobile          = $request->input('mobile');
        $hamis->mobile2         = $request->input('mobile2');
        $hamis->tel             = $request->input('tel');
        $hamis->description     = $request->input('description');
        $hamis->status          = 1;

        $hamis->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('siteusers.index'));

    }
    public function edit($id)
    {
        $hamis              = Hami::whereId($id)->get();
        $acountnumbers      = acountnumber::whereUser_id($id)->get();
        $typeusers          = Type_user::where('id' , 3)->get();
        $banks              = Bank::all();
        $userhamahang       = User::select('id' , 'name')->whereType_id(2)->get();
        $userjazb           = User::select('id' , 'name')->whereType_id(4)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.siteusers.edit')
            ->with(compact('acountnumbers'))
            ->with(compact('banks'))
            ->with(compact('userhamahang'))
            ->with(compact('userjazb'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('typeusers'))
            ->with(compact('hamis'));
    }

    public function update(Request $request , $id)
    {

        $hami = Hami::findOrfail($id);

        $hami->name             = $request->input('name');
        $hami->mobile           = $request->input('mobile');
        $hami->mobile2          = $request->input('mobile2');
        $hami->date             = $request->input('date');
        $hami->hamahang_id      = $request->input('hamahang_id');
        $hami->tel              = $request->input('tel');
        $hami->description      = $request->input('description');
        $hami->status           = $request->input('status');
        $hami->phone_verify     = $request->input('phone_verify');

        $hami->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('siteusers.index'));
    }

    public function destroy($id)
    {
        $hami = Hami::findOrfail($id);
        $hami->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return back();
    }
}
