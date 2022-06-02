@extends('Admin.admin')
@section('title')
    <title> مدیریت حضور و غیاب </title>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت حضور و غیاب </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت حضور و غیاب </li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست حضور و غیاب </h6>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> کد کارشناس </th>
                                            <th class="wd-10p"> نام و نام خانوادگی </th>
                                            <th class="wd-10p"> تاریخ امروز </th>
                                            <th class="wd-10p"> ساعت ورود </th>
                                            <th class="wd-10p"> ساعت خروج </th>
                                            <th class="wd-10p"> اضافه کار </th>
                                            <th class="wd-10p"> کسری </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p">ثبت حضور</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr class="odd gradeX">

                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{jdate()->format('%Y/%m/%d')}}</td>
                                                <td>{{$user->entertime}}</td>
                                                <td>{{$user->exittime}}</td>
                                                <td>{{$user->overtime}}</td>
                                                <td>{{$user->lowtime}}</td>
                                                @if($user->entertime)
                                                    <td><b class="text-success">حاضر</b></td>
                                                @else
                                                    <td><b class="text-danger">غایب</b></td>
                                                @endif
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$user->id}}">ثبت زمان</button>

                                                    <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">ثبت اطلاعات حضور و غیاب {{$user->name}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{route('rollcalls.store')}}" method="POST">

                                                                        {{csrf_field()}}
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="col-form-label">ساعت ورود</label>
                                                                            <input type="time" name="entertime" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="col-form-label">ساعت خروج</label>
                                                                            <input type="time" name="exittime"  class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="col-form-label"> اضافه کار</label>
                                                                            <input type="time" name="overtime"  class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="col-form-label">کسر </label>
                                                                            <input type="time" name="lowtime"  class="form-control">
                                                                        </div>
                                                                        <input type="hidden" name="user_id" value="{{$user->id}}" class="form-control">
                                                                        <input type="hidden" name="date" value="{{jdate()->format('%Y/%m/%d')}}" class="form-control">
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary">ثبت</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
