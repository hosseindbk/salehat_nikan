<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\userrequest;
use App\Model\acountnumber;
use App\Model\Bank;
use App\Model\Menudashboard;
use App\Model\Submenudashboard;
use App\Model\Type_user;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $users->melicode        = $request->input('melicode');
        $users->type_id         = $request->input('type_id');
        $users->mobile          = $request->input('mobile');
        $users->mobile2         = $request->input('mobile2');
        $users->mobile3         = $request->input('mobile3');
        $users->email           = $request->input('email');
        $users->tel             = $request->input('tel');
        $users->tel2            = $request->input('tel2');
        $users->tel3            = $request->input('tel3');
        $users->address         = $request->input('address');
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
        $user->melicode         = $request->input('melicode');
        $user->type_id          = $request->input('type_id');
        $user->mobile           = $request->input('mobile');
        $user->mobile2          = $request->input('mobile2');
        $user->mobile3          = $request->input('mobile3');
        $user->email            = $request->input('email');
        $user->tel              = $request->input('tel');
        $user->tel2             = $request->input('tel2');
        $user->tel3             = $request->input('tel3');
        $user->address          = $request->input('address');
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
