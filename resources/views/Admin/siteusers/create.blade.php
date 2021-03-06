@extends('Admin.admin')
@section('title')
    <title> ایجاد حامی جدید</title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت حامیان</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/users')}}"> مدیریت حامیان</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد حامیان</li>
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
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label text-center mb-5">ورود اطلاعات حامیان</h6>
                                </div>
                                <form action="{{ route('siteusers.store')}}" method="POST">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">نام و نام خانوادگی حامی</p>
                                                <input type="text" name="name" required  placeholder="نام و نام خانوادگی را وارد کنید" class="form-control" />
                                            </div>

                                            <div class="form-group">
                                                <p class="mg-b-10">حامی یاب</p>
                                                <select name="hamahang_id" required class="form-control select-lg select2">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($userhamahang as $user)
                                                        <option value="{{$user->id}}" {{$user->id == Auth::user()->id ? 'selected' : ''}}>{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">نوع عضویت</p>
                                                <select name="type_id" required class="form-control select-lg select2">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($typeusers as $typeuser)
                                                        <option value="{{$typeuser->id}}" {{$typeuser->id == 3 ? 'selected' : ''}}>{{$typeuser->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">شماره موبایل</p>
                                                <input type="text" name="mobile" required placeholder="شماره موبایل را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">شماره موبایل2</p>
                                                <input type="text" name="mobile2"  placeholder="شماره موبایل را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">تاریخ عضویت</p>
                                                <input type="text" name="date" autocomplete="off"  class="form-control fc-datepicker" placeholder="روز / ماه / سال" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">تلفن ثابت</p>
                                                <input type="text" name="tel"  placeholder="تلفن ثابت را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">توضیحات </p>
                                                <textarea name="description" id="" cols="50" rows="2" class="form-control"></textarea>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('end')
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <script src="{{asset('admin/assets/js/form-elements.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.3/dist/cleave.min.js"></script>
@endsection
@endsection
