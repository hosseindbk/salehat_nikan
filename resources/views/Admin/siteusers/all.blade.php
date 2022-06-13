@extends('Admin.admin')
@section('title')
    <title> مدیریت حامیان </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('keramat/vendors/dataTable/v1/css/semantic.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('keramat/vendors/dataTable/v1/css/dataTables.semanticui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('keramat/vendors/dataTable/v1/css/buttons.semanticui.min.css')}}" type="text/css">
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
                                <div class="row">
                                    <form method="get" action="{{ url('admin/siteusers') }}" style="display: flex">
                                        <input type="number" class="form-control" name="page"    value="{{$page}}" autocomplete="off" style="width: 100px">
                                        <button type="submit" class="btn btn-default">بروزرسانی جدول</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1" style="float: right">لیست حامیان </h6>

                                    <div class="form-group col-md-2" style="float: left;text-align: center">
                                        <a href="{{url('admin/siteusers/create')}}" class="btn btn-default">افزودن حامی </a>
                                    </div>
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
                                                <th class="wd-10p"> ردیف </th>
                                                <th class="wd-10p"> کد حامی </th>
                                                <th class="wd-10p"> نام و نام خانوادگی </th>
                                                <th class="wd-10p"> شماره موبایل </th>
                                                <th class="wd-10p"> تاریخ عضویت </th>
                                                <th class="wd-10p"> حامی یاب </th>
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

    <script src="{{asset('keramat/vendors/dataTable/v1/semantic.min.js')}}"></script>
    <script src="{{asset('keramat/vendors/dataTable/v1/dataTables.semanticui.min.js')}}"></script>
    <script src="{{asset('keramat/vendors/dataTable/v1/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('keramat/vendors/dataTable/v1/buttons.semanticui.min.js')}}"></script>
    <script src="{{asset('keramat/vendors/dataTable/v1/jszip.min.js')}}"></script>
    <script src="{{asset('keramat/vendors/dataTable/v1/vfs_fonts.js')}}"></script>
    <script src="{{asset('keramat/vendors/dataTable/v1/buttons.html5.min.js')}}"></script>
    <script src="{{asset('keramat/vendors/dataTable/v1/buttons.print.min.js')}}"></script>
    <script src="{{asset('keramat/vendors/dataTable/v1/buttons.colVis.min.js')}}"></script>

    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
    <script type="text/javascript">

        $(function () {
            var table = $('.yajra-datatable').DataTable({
                order: [[ 1, 'desc' ]],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'اکسل',
                        className: 'btn btn-default btn-xs'
                    },
                    {
                        extend: 'print',
                        text: 'پرینت و pdf',
                        className: 'btn btn-default btn-xs',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'

                ],
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': true
                    }
                ],
                "lengthChange": true,
                "pageLength": '{{$page}}',

                processing: true,
                serverSide: true,
                orderable: true,
                searchable: true,
                fixedHeader: false,
                orderCellsTop: false,
                ajax: "{{ route('siteusers.index') }}",
                columns: [
                    {data: 'DT_RowIndex'    , name: 'DT_RowIndex'   },
                    {data: 'id'             , name: 'id'            },
                    {data: 'name'           , name: 'name'          },
                    {data: 'mobile'         , name: 'mobile'        },
                    {data: 'date'           , name: 'date'          },
                    {data: 'username'       , name: 'username'      },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        });

        $(document).ready(function() {
            table.buttons().container()
                .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
        });
    </script>
@endsection
