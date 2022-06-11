<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Cost;
use App\Model\Menudashboard;
use App\Model\Submenudashboard;
use App\Model\Type_user;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostController extends Controller
{
    public function index(){

        $costs              = Cost::leftjoin('users' , 'users.id' , '=' , 'costs.user_id')
        ->select('costs.reason as reason' , 'costs.amount as amount' , 'costs.description as description' , 'users.name as name','costs.date as time' )
        ->orderBy('costs.id' , 'DESC')
        ->get();

        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.costs.all')
            ->with(compact('costs'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function create()
    {
        $typeusers          = Type_user::where('id' , 3)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.costs.create')
            ->with(compact('typeusers'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(Request $request)
    {
        $costs = new cost();

        $costs->user_id         = auth::user()->id;
        $costs->amount          = str_replace(',' , '' , $request->input('amount'));
        $costs->date            = $request->input('date');
        $costs->reason          = $request->input('reason');
        $costs->description     = $request->input('description');
        $costs->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('costs.index'));

    }

    public function edit($id)
    {
        $users              = User::whereId($id)->get();
        $acountnumbers      = acountnumber::whereUser_id($id)->get();
        $typeusers          = Type_user::where('id' , 3)->get();
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

    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return back();
    }
}
