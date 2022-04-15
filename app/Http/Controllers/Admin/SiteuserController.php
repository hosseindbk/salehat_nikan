<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\acountnumber;
use App\Model\Bank;
use App\Model\Menudashboard;
use App\Model\Submenudashboard;
use App\Model\Type_user;
use App\Model\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SiteuserController extends Controller
{

    public function index(Request $request)
    {
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        if ($request->ajax()) {
            $data = User::select('id' , 'name' , 'mobile' , 'date' , 'type_id' , 'hamahang' , 'jazb' , 'phone_verify' , 'status')->where('level' , '=', null)->get();
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
                ->editColumn('hamahang', function ($data) {
                    return ($data->hamahang);
                })
                ->editColumn('jazb', function ($data) {
                    return ($data->jazb);
                })
                ->editColumn('phone_verify', function ($data) {
                    if ($data->phone_verify == "0") {
                        return 'تایید نشده';
                    }elseif ($data->phone_verify == "1") {
                        return 'فعال';
                    }
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == "1") {
                        return 'ثبت نام اولیه';
                    }elseif ($data->status == "2") {
                        return 'فعال';
                    }elseif ($data->status == "3") {
                        return 'غیر فعال';
                    }
                })

                ->addColumn('action', function($row){
                    $actionBtn = '<a href="' . route('siteusers.edit' , $row->id) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                  <form action="' . route('siteusers.destroy' , $row->id) .'" method="post" style="display:inline">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                         <button type="submit" class="btn ripple btn-outline-danger btn-sm">
                                             <i class="fe fe-trash-2 "></i>
                                         </button>
                                </form>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.siteusers.all')
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

    public function store(Request $request)
    {
        if($request->input('hamahang_id') != null) {
            $hamahang = User::whereId($request->input('hamahang_id'))->pluck('name');
            $hamahangi = $hamahang[0];
        }else{
            $hamahangi = null;
        }
        if($request->input('jazb_id') != null) {
            $jazb = User::whereId($request->input('jazb_id'))->pluck('name');
            $jazbi = $jazb[0];
        }else{
            $jazbi = null;
        }

        $users = new user();

        $users->name            = $request->input('name');
        $users->type_id         = $request->input('type_id');
        $users->jazb            = $jazbi;
        $users->jazb_id         = $request->input('jazb_id');
        $users->hamahang        = $hamahangi;
        $users->hamahang_id     = $request->input('hamahang_id');
        $users->mobile          = $request->input('mobile');
        $users->phone           = $request->input('mobile');
        $users->mobile2         = $request->input('mobile2');
        $users->tel             = $request->input('tel');
        $users->description     = $request->input('description');
        $users->status          = 1;


        $users->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('siteusers.index'));

    }
    public function edit($id)
    {
        $users              = User::whereId($id)->get();
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
            ->with(compact('users'));
    }

    public function update(Request $request , $id)
    {
        if($request->input('hamahang_id') != null) {
            $hamahang = User::whereId($request->input('hamahang_id'))->pluck('name');
            $hamahangi = $hamahang[0];
        }else{
            $hamahangi = null;
        }
        if($request->input('jazb_id') != null) {
            $jazb = User::whereId($request->input('jazb_id'))->pluck('name');
            $jazbi = $jazb[0];
        }else{
            $jazbi = null;
        }

        $user = User::findOrfail($id);

        $user->name             = $request->input('name');
        $user->type_id          = $request->input('type_id');
        $user->mobile           = $request->input('mobile');
        $user->phone            = $request->input('mobile');
        $user->mobile2          = $request->input('mobile2');
        $user->jazb            = $jazbi;
        $user->jazb_id         = $request->input('jazb_id');
        $user->hamahang        = $hamahangi;
        $user->hamahang_id     = $request->input('hamahang_id');
        $user->tel              = $request->input('tel');
        $user->description      = $request->input('description');
        $user->status           = $request->input('status');
        $user->phone_verify     = $request->input('phone_verify');

        $user->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('siteusers.index'));
    }

    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return back();
    }
}
