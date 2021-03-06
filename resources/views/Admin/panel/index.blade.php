@extends('Admin.admin')
@section('title')
    <title> داشبورد مدیریتی موسسه خیریه صالحات نیکان</title>
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
                </div>
                @foreach($submenudashboards as $submenudashboard)
                    @if($submenudashboard->title == 'users')
                        @can($submenudashboard->namayesh)
                            <div class="row row-sm">
                                <div class="col-lg-12">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="main-content-label mb-1">جدول حامیان</h6>
                                            </div>
                                            <div class="table-responsive" style="height: 500px">
                                                <table class="table text-nowrap text-md-nowrap table-bordered mg-b-0">
                                                    <thead>
                                                    <tr>
                                                        <th>نام و نام خانوادگی</th>
                                                        <th>شماره موبایل</th>
                                                        <th>زمان ثبت </th>
                                                        <th>وضعیت</th>
                                                        <th>ویرایش اطلاعات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($hamis as $user)
                                                        <tr>
                                                            <td scope="row">{{$user->name}}</td>
                                                            <td>{{$user->mobile}}</td>
                                                            <td>{{jdate($user->created_at)->ago()}}</td>
                                                            <td>
                                                                @if($user->status == 1)
                                                                    <button class="btn ripple btn-outline-info">ثبت نام اولیه</button>
                                                                @elseif($user->status == 2)
                                                                    <button class="btn ripple btn-outline-success">فعال</button>
                                                                @elseif($user->status == 0)
                                                                    <button class="btn ripple btn-outline-warning">غیر فعال</button>
                                                                @endif
                                                            </td>
                                                            <td>
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
                            </div>
                            <div class="row row-sm">
                                <div class="col-lg-12">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="main-content-label mb-1">جدول هماهنگ کننده و حامی یاب</h6>
                                            </div>
                                            <div class="table-responsive" style="height: 500px">
                                                <table class="table text-nowrap text-md-nowrap table-bordered mg-b-0">
                                                    <thead>
                                                    <tr>
                                                        <th>نام و نام خانوادگی</th>
                                                        <th>شماره موبایل</th>
                                                        <th>زمان ثبت </th>
                                                        <th>وضعیت</th>
                                                        <th>ویرایش اطلاعات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($hamahang as $user)
                                                        <tr>
                                                            <td scope="row">{{$user->name}}</td>
                                                            <td>{{$user->mobile}}</td>
                                                            <td>{{jdate($user->created_at)->ago()}}</td>
                                                            <td>
                                                                @if($user->status == 1)
                                                                    <button class="btn ripple btn-outline-info">ثبت نام اولیه</button>
                                                                @elseif($user->status == 2)
                                                                    <button class="btn ripple btn-outline-success">فعال</button>
                                                                @elseif($user->status == 0)
                                                                    <button class="btn ripple btn-outline-warning">غیر فعال</button>
                                                                @endif
                                                            </td>
                                                            <td>
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
