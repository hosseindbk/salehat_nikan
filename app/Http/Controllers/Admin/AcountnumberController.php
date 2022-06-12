<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\acountnumber;
use App\Model\deposit;
use App\Model\Menudashboard;
use App\Model\Submenudashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AcountnumberController extends Controller
{

    public function index()
    {
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

                $datas = deposit::groupBy('acountnumber_id')
                    ->selectRaw('sum(amount) as sum, count(amount) as count, acountnumber_id')
                    ->Hesabfilter()
                    ->get();
                //dd($data);

        $account_numbers = acountnumber::select('id' , 'title')->get();


        return view('Admin.accountnumbers.all')
            ->with(compact('account_numbers'))
            ->with(compact('datas'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $acountnumbers = new acountnumber();

        $acountnumbers->bank_id             = $request->input('bank_id');
        $acountnumbers->shomare_hesab       = $request->input('shomare_hesab');
        $acountnumbers->shomare_card        = $request->input('shomare_card');
        $acountnumbers->shomare_sheba       = $request->input('shomare_sheba');
        $acountnumbers->user_id             = $request->input('user_id');

        $acountnumbers->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();
    }

    public function acountnumber(Request $request){
        $acountnumbers = acountnumber::whereUser_id($request->input('id'))->get();
        $output = [];

        foreach($acountnumbers as $acountnumber )
        {
            $output[$acountnumber->id] = $acountnumber->shomare_card;
        }
        return $output;
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $acountnumber = acountnumber::findOrfail($id);

        $acountnumber->delete();

        return  Redirect::back();
    }
}
