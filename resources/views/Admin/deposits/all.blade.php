@extends('Admin.admin')
@section('title')
    <title> مدیریت واریزی ها </title>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت واریزی ها </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت واریزی ها </li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست واریزی ها </h6>
                                    <a href="{{url('admin/deposits/create')}}" class="btn btn-primary btn-xs">افزودن واریزی </a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> کد کاربر </th>
                                            <th class="wd-10p"> تاریخ واریز </th>
                                            <th class="wd-10p"> نام و نام خانوادگی </th>
                                            <th class="wd-10p"> شماره موبایل </th>
                                            <th class="wd-10p"> مبلغ واریزی(تومان) </th>
                                            <th class="wd-10p"> علت واریز </th>
                                            <th class="wd-10p"> شماره کارت </th>
                                            <th class="wd-10p"> کد رهگیری </th>
                                            <th class="wd-10p"> هماهنگ کننده </th>
                                            <th class="wd-10p"> ویرایش/حذف</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deposits as $deposit)
                                            <tr class="odd gradeX">

                                                <td>{{$deposit->userid}}</td>
                                                <td>{{$deposit->date}}</td>
                                                <td>{{$deposit->name}}</td>
                                                <td>{{$deposit->mobile}}</td>
                                                <td>{{number_format($deposit->amount)}}</td>
                                                <td>{{$deposit->reason}}</td>
                                                <td>{{$deposit->hesabtitle}} - {{$deposit->shomare_hesab}}</td>
                                                <td>{{$deposit->code}}</td>
                                                <td>{{$deposit->hamahangname}}</td>
                                                <td>
                                                    <div class="btn-icon-list" style="float: right;">
                                                        <a href="{{ route('deposits.edit' , $deposit->id) }}" class="btn ripple btn-outline-info btn-icon">
                                                            <i class="fe fe-edit-2"></i>
                                                        </a>
                                                    </div>

                                                    <form action="{{ route('deposits.destroy' , $deposit->id) }}" method="post" style="float: left;">
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
@endsection
@endsection
