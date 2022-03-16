<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Menudashboard;
use App\Model\Submenudashboard;
use Illuminate\Http\Request;

class MenudashboardController extends Controller
{

    public function index()
    {
        $menudashs = Menudashboard::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::all();

        return view('Admin.menudashboards.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('menudashs'));
    }

}
