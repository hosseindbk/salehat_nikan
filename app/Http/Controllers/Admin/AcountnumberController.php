<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\acountnumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AcountnumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acountnumber = acountnumber::findOrfail($id);

        $acountnumber->delete();

        return  Redirect::back();
    }
}
