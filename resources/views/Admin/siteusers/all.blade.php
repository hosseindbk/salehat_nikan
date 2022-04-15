@extends('Admin.admin')
@section('title')
    <title> مدیریت حامیان </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">مدیریت حامیان </li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست حامیان </h6>
                                    <a href="{{url('admin/siteusers/create')}}" class="btn btn-primary btn-xs">افزودن حامیان </a>
                                </div>

                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        <style>
                                            table{
                                                margin: 0 auto;
                                                width: 100% !important;
                                                clear: both;
                                                border-collapse: collapse;
                                                table-layout: fixed;
                                                word-wrap:break-word;
                                            }
                                            td {
                                                overflow-x: auto;
                                            }
                                        </style>
                                        <table id="sample1" class="table table-striped table-bordered yajra-datatable">
                                            <thead>
                                            <tr>
                                                <th class="wd-10p"> کد حامی </th>
                                                <th class="wd-10p"> نام و نام خانوادگی </th>
                                                <th class="wd-10p"> شماره موبایل </th>
                                                <th class="wd-10p"> تاریخ عضویت </th>
                                                <th class="wd-10p"> هماهنگ کننده </th>
                                                <th class="wd-10p"> جذب کننده </th>
                                                <th class="wd-10p"> وضعیت شماره </th>
                                                <th class="wd-10p"> وضعیت </th>
                                                <th class="wd-10p"> ویرایش/حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('siteusers.index') }}",
                columns: [
                    {data: 'id'             , name: 'id'            },
                    {data: 'name'           , name: 'name'          },
                    {data: 'mobile'         , name: 'mobile'        },
                    {data: 'date'           , name: 'date'          },
                    {data: 'hamahang'       , name: 'hamahang'      },
                    {data: 'jazb'           , name: 'jazb'          },
                    {data: 'phone_verify'   , name: 'phone_verify'  },
                    {data: 'status'         , name: 'status'        },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
@endsection
