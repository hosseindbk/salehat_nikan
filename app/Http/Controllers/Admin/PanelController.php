<?php

namespace App\Http\Controllers\Admin;

use App\Model\Menudashboard;
use App\Model\Category;
use App\Model\Submenudashboard;
use App\Model\Type_user;
use App\Model\User;
use App\Model\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{

    public function index()
    {
        $countusers         = User::count();
        $categories         = category::whereStatus(1)->get();
        $typeusers          = Type_user::all();
        $users              = User::orderBy('id' , 'DESC')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        $day = jdate()->getDay();
        $month = jdate()->getMonth();

        $dayvisitos  = Visitor::selectRaw('substring(datetime , 6,2 ) month , substring(datetime , 9,2 ) day, count(ip) publish')
            ->groupBy('day' , 'month')
            ->having('day' , '=', $day)
            ->having('month' , '=', $month)
            ->pluck('publish')->first();

        $monthvisits = Visitor::selectRaw('substring(datetime , 6,2 ) month , count(*) publish')
            ->groupBy('month')
            ->having('month' , '=', $month)
            ->pluck('publish')->first();

        $month = 12;

        $visitos = Visitor::selectRaw('substring(datetime , 6,2 ) month , count(*) publish')
            ->groupBy('month')
            ->pluck('publish');
        $visitors = $this->CheckCount($visitos , $month);

        $pievisitors = Visitor::selectRaw('page_id , count(*) publish')
            ->groupBy('page_id')
            ->pluck('publish');



        $lables = $this->getLastMonths($month);

        return view('Admin.panel.index')

            ->with(compact('categories'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('dayvisitos'))
            ->with(compact('pievisitors'))
            ->with(compact('visitors'))
            ->with(compact('typeusers'))
            ->with(compact('users'))
            ->with(compact('countusers'))
            ->with(compact('monthvisits'))
            ->with(compact('lables'));
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
