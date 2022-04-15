@extends('Admin.admin')
@section('title')
    <title> ویرایش حامیان </title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css-rtl/colors/default.css')}}" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت حامیان </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/siteusers')}}"> مدیریت حامیان </a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش حامیان </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            @foreach($users as $user)
                                <div class="card-body">
                                    <div>
                                        <h6 class="main-content-label text-center mb-5">ویرایش اطلاعات حامیان </h6>
                                    </div>

                                    <form action="{{ route('siteusers.update', $user->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{ method_field('PATCH') }}
                                        <div class="row row-sm">
                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام و نام خانوادگی</p>
                                                    <input type="text" name="name"  value="{{$user->name}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن ثابت</p>
                                                    <input type="text" name="tel" value="{{$user->tel}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">هماهنگ کننده</p>
                                                    <select name="hamahang_id" class="form-control select-lg select2">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach($userhamahang as $huser)
                                                            <option value="{{$huser->id}}" {{$huser->id == $user->hamahang_id ? 'selected' : ''}}>{{$huser->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">حامی یاب</p>
                                                    <select name="jazb_id" class="form-control select-lg select2">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach($userjazb as $juser)
                                                            <option value="{{$juser->id}}">{{$juser->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت کاربر</p>
                                                    <select name="status" class="form-control select-lg select2">

                                                            <option value="1" {{$user->status == 1 ? 'selected' : ''}}>ثبت اولیه </option>
                                                            <option value="2" {{$user->status == 2 ? 'selected' : ''}}>فعال </option>
                                                            <option value="3" {{$user->status == 3 ? 'selected' : ''}}>غیر فعال </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">وضعیت شماره کاربر</p>
                                                    <select name="phone_verify" class="form-control select-lg select2">
                                                        <option value="0" {{$user->phone_verify == 0 ? 'selected' : ''}}>عدم تایید شماره</option>
                                                        <option value="1" {{$user->phone_verify == 1 ? 'selected' : ''}}> تایید شماره</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب نوع عضویت</p>
                                                    <select name="type_id" class="form-control select-lg select2">
                                                        @foreach($typeusers as $type_user)
                                                            <option value="{{$type_user->id}}" {{$user->type_id == $type_user->id ? 'selected' : ''}}>{{$type_user->title}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">شماره موبایل</p>
                                                    <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">شماره موبایل2</p>
                                                    <input type="text" name="mobile2" value="{{$user->mobile2}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">توضیحات</p>
                                                    <textarea name="descripion" id="" rows="2" class="form-control">{{$user->descripion}}</textarea>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 mg-b-10 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($users as $user) افزودن شماره های حساب  {{$user->name}} @endforeach</span></h3>
                                </div>
                                <form action="{{ route('acountnumber.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب بانک</p>
                                                <select name="bank_id" class="form-control select-lg select2">
                                                    <option value=""></option>
                                                    @foreach($banks as $bank)
                                                        <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="user_id" value="{{$user->id}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">شماره حساب</p>
                                                <input type="text" name="shomare_hesab" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">شماره کارت</p>
                                                <input type="text" name="shomare_card" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">شماره شبا</p>
                                                <input type="text" name="shomare_sheba" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info m-r-20 text-center">ذخیره اطلاعات</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> نام بانک </th>
                                            <th class="wd-10p"> شماره حساب </th>
                                            <th class="wd-10p"> شماره کارت </th>
                                            <th class="wd-10p"> شماره شبا </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($acountnumbers as $acountnumber)
                                            <tr class="odd gradeX">
                                                <td>{{$s++}}</td>
                                                <td>
                                                    @foreach($banks as $bank)
                                                        @if($bank->id == $acountnumber->bank_id)
                                                            {{$bank->bank_name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{$acountnumber->shomare_hesab}}
                                                </td>
                                                <td>
                                                    {{$acountnumber->shomare_card}}
                                                </td>
                                                <td>
                                                    {{$acountnumber->shomare_sheba}}
                                                </td>

                                                <td>
                                                    <form action="{{ route('acountnumber.destroy' , $acountnumber->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-danger btn-xs">
                                                                <i class="fe fe-trash-2 "></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('end')
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

@endsection

