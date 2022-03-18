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
        $users              = User::where('id' ,'>' , 1)->orderBy('id' , 'DESC')->get();
        $typeusers          = Type_user::all();
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
        $typeusers = Type_user::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();
        return view('Admin.siteusers.create')
            ->with(compact('typeusers'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(Request $request)
    {
        $users = new user();

        $users->name            = $request->input('name');
        $users->type_id         = $request->input('type_id');
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
        $typeusers          = Type_user::all();
        $banks              = Bank::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.siteusers.edit')
            ->with(compact('acountnumbers'))
            ->with(compact('banks'))
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
        $user->tel              = $request->input('tel');
        $user->description      = $request->input('description');
        $user->status           = $request->input('status');
        $user->phone_verify     = $request->input('phone_verify');

        $user->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('siteusers.index'));
    }


    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return back();
    }
}
