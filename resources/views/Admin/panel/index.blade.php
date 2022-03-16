@extends('Admin.admin')
@section('title')
    <title> داشبورد مدیریتی بستا</title>
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="row row-sm  mt-lg-4">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="card bg-primary custom-card card-box">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="offset-xl-12 offset-sm-12 col-xl-12 col-sm-12 col-12 img-bg ">
                                                <h4 class="d-flex  mb-3">
                                                    <span class="font-weight-bold text-white ">پیام ادمین</span>
                                                </h4>
                                                <p class="tx-white-7 mb-1">شما در پنل باید اطلاعات خود را تکمیل نمایید تا اجازه دسترسی برای {{Auth::user()->name}}  عزیز فعال گردد.</p></div>
                                            <img src="{{asset('admin/assets/img/pngs/work3.png')}}" alt="user-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header border-bottom-0">
                                <div>
                                    <label class="main-content-label mb-2">نرخ بازدید وبسایت </label>
                                    <span class="d-block tx-12 mb-0 text-muted">نرخ بازدید وب سایت بصورت ماهانه می باشد</span>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class="">
                                    <div class="container">
                                        <canvas id="chartLine" class="chart-dropshadow2 ht-250"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($submenudashboards as $submenudashboard)
                        @if($submenudashboard->title == 'users')
                            @can($submenudashboard->namayesh)
                                <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card custom-card mg-b-20">
                            <div class="card-body" style="max-height: 500px; overflow: auto;">
                                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                    <div>
                                        <label class="main-content-label mb-2">کاربران وبسایت </label>
                                    </div>
                                </div>
                                <div class="table-responsive tasks">
                                    <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-10p">نام و نام خانوادگی</th>
                                            <th class="wd-lg-20p">شماره موبایل</th>
                                            <th class="wd-lg-20p">ایمیل</th>
                                            <th class="wd-lg-20p">نوع همکاری</th>
                                            <th class="wd-lg-20p">زمان ثبت </th>
                                            <th class="wd-lg-20p">وضعیت</th>
                                            <th class="wd-lg-20p">ویرایش اطلاعات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="text-primary">{{$user->name}}</td>
                                                <td class="text-nowrap">{{$user->phone}}</td>
                                                <td class="text-nowrap">
                                                    @foreach($typeusers as $type_user)
                                                        @if($type_user->id == $user->type_id)
                                                            {{$type_user->title}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{jdate($user->created_at)->ago()}}</td>
                                                <td class="text-nowrap">
                                                    @if($user->status == 1)
                                                        <button class="btn ripple btn-outline-info">ثبت نام اولیه</button>
                                                    @elseif($user->status == 2)
                                                        <button class="btn ripple btn-outline-success">تایید مدیر</button>
                                                    @elseif($user->status == 0)
                                                        <button class="btn ripple btn-outline-warning">غیر فعال</button>
                                                    @endif
                                                </td>
                                                <td  class="text-nowrap">
                                                    <a href="{{ route('siteusers.edit' , $user->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                            @endcan
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@section('end')
    <script src="{{asset('admin/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/index.js')}}"></script>
@endsection
@endsection
