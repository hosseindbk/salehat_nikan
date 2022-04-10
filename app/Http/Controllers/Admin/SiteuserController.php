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

class SiteuserController extends Controller
{

    public function index()
    {
        $users              = User::where('level' , '=', null)->orderBy('id' , 'DESC')->get();
        $typeusers          = Type_user::where('id' , 3)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.siteusers.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('typeusers'))
            ->with(compact('users'));
    }
    public function create()
    {
        $typeusers          = Type_user::where('id' , 3)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        $userhamahang       = User::select('id' , 'name')->whereType_id(2)->get();
        $userjazb           = User::select('id' , 'name')->whereType_id(5)->get();
        return view('Admin.siteusers.create')
            ->with(compact('userhamahang'))
            ->with(compact('userjazb'))
            ->with(compact('typeusers'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(Request $request)
    {
        $users = new user();

        $users->name            = $request->input('name');
        $users->type_id         = $request->input('type_id');
        $users->jazb            = $request->input('jazb');
        $users->hamahang        = $request->input('hamahang');
        $users->mobile          = $request->input('mobile');
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
        $userjazb           = User::select('id' , 'name')->whereType_id(5)->get();
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
        $user = User::findOrfail($id);

        $user->name             = $request->input('name');
        $user->type_id          = $request->input('type_id');
        $user->mobile           = $request->input('mobile');
        $user->mobile2          = $request->input('mobile2');
        $user->jazb            = $request->input('jazb');
        $user->hamahang        = $request->input('hamahang');
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
