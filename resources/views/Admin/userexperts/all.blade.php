@extends('Admin.admin')
@section('title')
    <title> مدیریت کارشناسان </title>
    <link href="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min-rtl.css')}} " rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کارشناسان </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت کارشناسان </li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست کارشناسان </h6>
                                    <a href="{{url('admin/user-experts/create')}}" class="btn btn-primary btn-xs">افزودن کارشناسان </a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> کد حامی </th>
                                            <th class="wd-10p"> نام و نام خانوادگی </th>
                                            <th class="wd-10p"> شماره موبایل </th>
                                            <th class="wd-10p"> تاریخ عضویت </th>
                                            <th class="wd-10p"> سطح </th>
                                            <th class="wd-10p"> وضعیت شماره </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> ویرایش/حذف</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr class="odd gradeX">

                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->mobile}}</td>
                                                <td>{{jdate($user->created_at)->format('%Y/%m/%d')}}</td>
                                                <td>
                                                    @foreach($typeusers as $type_user)
                                                        @if($type_user->id == $user->type_id)
                                                            {{$type_user->title}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if($user->phone_verify == 0)
                                                        <button class="btn ripple btn-outline-info">تایید نشده</button>
                                                    @elseif($user->phone_verify == 1)
                                                        <button class="btn ripple btn-outline-success">تایید شده</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->status == 1)
                                                        <button class="btn ripple btn-outline-info">ثبت نام اولیه</button>
                                                    @elseif($user->status == 2)
                                                        <button class="btn ripple btn-outline-success">تایید مدیر</button>
                                                    @elseif($user->status == 0)
                                                        <button class="btn ripple btn-outline-warning">غیر فعال</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-icon-list" style="float: right;">
                                                        <a href="{{ route('user-experts.edit' , $user->id ) }}" class="btn ripple btn-outline-info btn-icon">
                                                            <i class="fe fe-edit-2"></i>
                                                        </a>
                                                    </div>
                                                    <form action="{{ route('user-experts.destroy' , $user->id) }}" method="post" style="float: left;">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn-icon-list">
                                                            <button type="submit" class="btn ripple btn-outline-danger btn-icon">
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
@section('end')
    <script src="{{asset('admin/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/table-data.js')}}"></script>
@endsection
@endsection
