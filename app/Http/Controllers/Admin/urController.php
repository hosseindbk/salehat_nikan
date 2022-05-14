<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\BookingModel;
use App\Models\dashboard\PermissionModel;
use App\Models\dashboard\ServiceLocation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ManageUserController extends Controller
{
    public function listUser(Request $request)
    {
        if($request->page)
            $page = $request->page;
        else
            $page = 25;
        if ($request->ajax()) {
            $log_yeksan = DB::table('users as u')
                ->select(
                    'u.id as id',
                    'u.username as username',
                    'u.name as name',
                    'u.family as family',
                    'u.status as status',
                    'sl.name as service_location',
                    'u.created_at as created_at'
                )
                ->join('service_location as sl', 'u.service_location_id', '=', 'sl.id')
                ->orderBy('u.created_at', 'desc');
            return Datatables::of($log_yeksan)
                ->editColumn('created_at', function ($data) {
                    return \Morilog\Jalali\Jalalian::forge($data->created_at)->format(' H:i:s %Y/%m/%d ');
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 5936) {
                        return '<span class="badge badge-success">فعال</span>';
                    }
                    else
                        return '<span class="badge badge-danger">غیر فعال</span>';
                })
                ->addColumn('action',function ($data){
                    return '<a href="'.route("manageUserEdit",['user_id' => Crypt::encryptString($data->id)]).'" title="ویرایش" type="button" class="btn btn-info btn-floating">
                                <i class="ti-pencil-alt"></i>
                            </a>';
                })
                ->addIndexColumn()
                ->rawColumns(['status','action'])
                ->make(true);
        }
        /*
                $users= User::with('serviceLocation')->orderBy('id','desc')->get();
        //       dd($users->serviceLocation);*/
        return view('dashboard.keramat.manageuser.listuser',compact('page'));
    }

    public function addUser()
    {
        $service_location_id=ServiceLocation::all();
        $permissions=PermissionModel::orderBy('id','DESC')->get();
        $userAccess=User::find(Auth::user()->id);
        $reserve_hotel = BookingModel::all();
        $access = json_decode($userAccess->url_permission);
        return view('dashboard.keramat.manageuser.adduser',compact('service_location_id','access','permissions','reserve_hotel'));

    }

    public function editUser($user_id)
    {
        $user_id=Crypt::decryptString($user_id);
        $service_location_id=ServiceLocation::all();
        $user = User::find($user_id);
        $url_permission = json_decode($user->url_permission);
        $reserve_hotel = BookingModel::all();
        $permissions=PermissionModel::orderBy('id','DESC')->get();
        if(ctype_digit($user_id)) {
            return view('dashboard.keramat.manageuser.edituser',compact('user','service_location_id','permissions','url_permission','reserve_hotel'));
        }
    }
    /**
     * @param Request $request
     * @return $this
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateUser(Request $request)
    {

        $this->validate(request(),[
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'service_location_id' => ['required', 'string', 'max:255'],
            'username' => ['required'],
            'status' => ['required', 'numeric'],
        ],[
            'name.required'=>'نام اجباری میباشد *',
            'name.string'=>'برای نام فقط حروف قابل قبول است *',
            'name.max'=>'حداکثر تعداد کاراکتر برای نام 255 کاراکتر میباشد *',
            'status.required'=>'انتخاب وضعیت اجباری می باشد *',
            'status.numeric'=>'کارکتر غیر مجاز *',
//            'status.max'=>'خطا ! *',
            'family.required'=>'این فیلد اجباری میباشد *',
            'family.string'=>'برای نام خانوادگی فقط حروف قابل قبول است *',
            'family.max'=>'حداکثر تعداد کاراکتر برای نام خانوادگی 255 کاراکتر میباشد *',
            'username.required'=>'نام کاربری اجباری میباشد *',
            'service_location_id.required'=>'انتخاب محل خدمت اجباری میباشد *',
            'service_location_id.string'=>'فقط حروف قابل قبول است *',
            'service_location_id.unique'=>'نام کاربری تکراری میباشد *',
        ]);
        $user_id = $request->input("user_id");
        $user_id=Crypt::decryptString($user_id);
        $old_username=User::find($user_id)->username;
        $password=$request->input('password');
        $status=$request->input('status');
        $permission=$request->input('url_permission');

        $name=$request->input('name');
        $family= $request->input('family');
        $service_location_id=$request->input('service_location_id');

        $userData=array();
        $userItem = User::find($user_id);
        $userData = [
            'status'=>$status,
            'name'=>$name,
            'family'=>$family,
            'url_permission'=>json_encode($permission),
            'service_location_id'=>$service_location_id,
        ];

        if(!is_null($password)){
            $this->validate(request(),[

                'password' => ['string', 'min:8', 'confirmed'],
            ],[
                'password.string'=>'فقط حروف قابل قبول است *',
                'password.min'=>'پسورد حداقل باید 8 کاراکتر باشد *',
                'password.confirmed'=>'تکرار کلمه ی عبور نادرست است *',
            ]);
            $userData ['password']=Hash::make($password);
        }
        if($old_username != ($request->input('username'))){
            $this->validate(request(),[

                'username' => ['required', 'string', 'max:255', 'unique:users'],
            ],[
                'username.string'=>'برای نام فقط حروف قابل قبول است *',
                'username.unique'=>'نام کاربری تکراری میباشد *',
                'username.required'=>'این فیلد اجباری میباشد *',
                'username.max'=>'حداکثر تعداد کاراکتر برای نام 255 کاراکتر میباشد *',
            ]);

            $username=$request->input('username');
            $userData ['username']=$username;
        }
        $userItem->update($userData);
        return redirect()->route("manageUserList")->with('message','success');
    }

    public function deleteUser(Request $request)
    {
//        $user_id=$request->input('user_id');
//        $user_id=Crypt::decryptString($user_id);
//        if(ctype_digit($user_id))
//        {
//            $deleteUser = User::find($user_id);
//            if($deleteUser instanceof User)
//            {Auth::logout($user_id);
//                User::where('id',$user_id)->delete();
//
//
//                               return redirect()->route("manageUserList")->with('message','success');
//            }
//        }
    }
}
