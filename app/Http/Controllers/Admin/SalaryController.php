<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Menudashboard;
use App\Model\Salary;
use App\Model\Submenudashboard;
use App\Model\Type_user;
use App\Model\User;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $users              = User::leftjoin('salaries' , 'salaries.user_id' , '=', 'users.id')
            ->select('users.id' , 'users.name' , 'salaries.reason' , 'salaries.amount' ,  'salaries.extramount' , 'salaries.lowamount' , 'salaries.totalamount' , 'salaries.description')
            ->where('users.level' , 'admin')
            ->where('users.id' ,  '>', 2000)
            ->get();

        $typeusers          = Type_user::where('id' , '=' ,  2)->where('id' , '=' ,  5)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.saleris.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('typeusers'))
            ->with(compact('users'));
    }

    public function store(Request $request){

        $amount = (int)str_replace(',' , '' , $request->input('amount'));
        $extramount = (int)str_replace(',' , '' , $request->input('extramount'));
        $lowamount = (int)str_replace(',' , '' , $request->input('lowamount'));


        $totalamount              = $amount + $extramount - $lowamount;

        $salaries = new Salary();

        $salaries->amount         = $amount;
        $salaries->extramount     = $extramount;
        $salaries->lowamount      = $lowamount;
        $salaries->totalamount    = $totalamount;
        $salaries->user_id        = $request->input('user_id');
        $salaries->date           = $request->input('date');
        $salaries->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('salaris.index'));
    }
}
