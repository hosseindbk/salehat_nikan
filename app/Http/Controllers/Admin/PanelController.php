<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Menudashboard;
use App\Model\Submenudashboard;
use App\Model\User;
use Carbon\Carbon;

class PanelController extends Controller
{

    public function index()
    {
        $categories         = category::whereStatus(1)->get();

        $hamis              = User::select('id' , 'name' , 'mobile' , 'status' , 'date')
            ->where('level' , '=', null)
            ->get();
        $hamahang              = User::select('id' , 'name' , 'mobile' , 'status' , 'date')
            ->where('level' , '=', 'admin')
            ->where('id' , '>', 1)
            ->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();


        return view('Admin.panel.index')

            ->with(compact('categories'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('hamahang'))
            ->with(compact('hamis'));
    }

    private function getLastMonths($month)
    {
        for ($i = 0 ; $i < $month ; $i++) {
            $labels[] = jdate(Carbon::now()->subMonths($i-1))->format('%B');
        }

        return array_reverse($labels);
    }

    private function CheckCount($count, $month)
    {
        for ($i = 0 ; $i < $month ; $i++) {
            $new[$i] = empty($count[$i]) ? 0 : $count[$i];
        }

        return ($new);
    }

}
