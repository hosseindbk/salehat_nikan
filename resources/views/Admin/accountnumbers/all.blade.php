@extends('Admin.admin')
@section('title')
    <title> مدیریت حساب ها </title>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت حساب ها </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت حساب ها </li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <form method="get" action="{{ route('account-numbers') }}">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="account_number"  class="form-control select2">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($account_numbers as $account_number)
                                                        <option value="{{$account_number->id}}">{{$account_number->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="statdate" class="form-control" autocomplete="off" placeholder="روز / ماه / سال" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="enddate" class="form-control" autocomplete="off" placeholder="روز / ماه / سال" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"><button type="submit" class="btn btn-default">بروزرسانی جدول</button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> نام حساب </th>
                                            <th class="wd-10p"> مجموع واریزی حساب </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($datas as $data)
                                            <tr class="odd gradeX">

                                                <td>{{$data->acountnumber_id}}</td>
                                                <td>{{number_format($data->sum)}}</td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                            <tfoot>
                                            <tr>
                                                <th class="totalcheck" style="text-align:right">مجموع واریزی کل : </th>
                                                <th class="totalcheck" style="text-align:right">{{ number_format($datas->sum('sum')) }}</th>
                                            </tr>
                                            </tfoot>
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
