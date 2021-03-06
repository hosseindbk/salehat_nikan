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
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class UserexpertController extends Controller
{

    public function index(Request $request)
    {
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        $page      = (!empty($_GET["page"]))   ? ($_GET["page"])   : (20);

        if ($request->ajax()) {
            $data = User::select('id' , 'name' , 'mobile' , 'created_at')
                ->where('level' , 'admin')
                ->where('id' ,  '>', 1)
                ->take($page)
                ->get();

            return Datatables::of($data)
                ->addColumn('id', function ($data) {
                    return ($data->id);
                })

                ->addColumn('name', function ($data) {
                    return ($data->name);
                })
                ->addColumn('mobile', function ($data) {
                    return ($data->mobile);
                })
                ->addColumn('created_at', function ($data) {
                    return (jdate($data->created_at)->format('%Y/%m/%d'));
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('user-experts.edit', $row->id) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                  <form action="' . route('user-experts.destroy', $row->id) . '" method="post" style="display:inline">
                                    ' . csrf_field() . '
                                    ' . method_field("DELETE") . '
                                         <button type="submit" class="btn ripple btn-outline-danger btn-sm">
                                             <i class="fe fe-trash-2 "></i>
                                         </button>
                                </form>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.userexperts.all')
            ->with(compact('page'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }
    public function create()
    {
        $typeusers          = Type_user::whereIn('id' , [2 , 5])->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.userexperts.create')
            ->with(compact('typeusers'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(Request $request)
    {
        $users = new user();

        $users->name            = $request->input('name');
        $users->type_id         = $request->input('type_id');
        $users->phone           = $request->input('mobile');
        $users->melicode        = $request->input('melicode');
        $users->tel             = $request->input('tel');
        $users->description     = $request->input('description');
        $users->address         = $request->input('address');
        $users->level           = 'admin';
        $users->salary          = str_replace(',' , '' , $request->input('salary'));
        $users->status          = 1;

        if ($request->file('meliimage') != null) {
            $file = $request->file('meliimage');
            $img = Image::make($file);
            $imagePath ="images/users/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $users->meliimage = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('shimage') != null) {
            $file = $request->file('shimage');
            $img = Image::make($file);
            $imagePath ="images/users/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $users->shimage = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $users->save();

        alert()->success('???????????? ????????', '?????????????? ???? ???????????? ?????? ????');
        return redirect(route('user-experts.index'));

    }
    public function edit($id)
    {
        $users              = User::whereId($id)->get();
        $acountnumbers      = acountnumber::whereUser_id($id)->get();
        $typeusers          = Type_user::where('id' , '=' ,  2)->where('id' , '=' ,  5)->get();
        $banks              = Bank::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.userexperts.edit')
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
        alert()->success('???????????? ????????', '?????????????? ???? ???????????? ?????? ????');
        return redirect(route('user-experts.index'));
    }


    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        alert()->success('???????????? ????????', '?????????????? ???? ???????????? ?????? ????');
        return back();
    }
}
