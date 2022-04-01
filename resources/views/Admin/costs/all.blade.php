@extends('Admin.admin')
@section('title')
    <title> مدیریت هزینه ها </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت هزینه ها </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت هزینه ها </li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست حامیان </h6>
                                    <a href="{{url('admin/costs/create')}}" class="btn btn-primary btn-xs">افزودن هزینه </a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> نام و نام خانوادگی </th>
                                            <th class="wd-10p"> تاریخ </th>
                                            <th class="wd-10p"> مبلغ (تومان) </th>
                                            <th class="wd-10p"> علت </th>
                                            <th class="wd-10p"> توضیحات </th>
                                            <th class="wd-10p"> ویرایش </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($costs as $cost)
                                            <tr class="odd gradeX">
                                                <td>{{$cost->name}}</td>
                                                <td>{{$cost->time}}</td>
                                                <td>{{number_format($cost->amount)}}</td>
                                                <td>{{$cost->reason}}</td>
                                                <td>{{$cost->description}}</td>

                                                <td>
{{--                                                    <div class="btn-icon-list">--}}
{{--                                                        <a href="{{ route('costs.edit' , $cost->id ) }}" class="btn ripple btn-outline-info btn-icon">--}}
{{--                                                            <i class="fe fe-edit-2"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
                                                </td>
                                                <td>
{{--                                                    <form action="{{ route('costs.destroy' , $cost->id) }}" method="post">--}}
{{--                                                        {{ method_field('delete') }}--}}
{{--                                                        {{ csrf_field() }}--}}
{{--                                                        <div class="btn-icon-list">--}}
{{--                                                            <button type="submit" class="btn ripple btn-outline-danger btn-icon">--}}
{{--                                                                <i class="fe fe-trash-2 "></i>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
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
