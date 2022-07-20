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
                                    <div class="form-group col-md-1 ">
                                        <input type="text" name="user_id" id="user_id" class="form-control " placeholder="کد کاربر">
                                    </div>
                                    <div class="form-group col-md-2 ">
                                        <input type="text" name="name" id="name" class="form-control " placeholder="نام و نام خانوادگی">
                                    </div>
                                    <div class="form-group col-md-2 ">
                                        <input type="text" name="mobile" id="mobile" class="form-control " placeholder="شماره موبایل">
                                    </div>
                                    <div class="form-group col-md-2 ">
                                        <input type="text" name="hamiyab" id="hamiyab" class="form-control" placeholder="حامی یاب">
                                    </div>
                                    <div class="form-group col-md-1 ">
                                        <input type="text" name="total" id="total" class="form-control " placeholder="تعداد واریزی">
                                    </div>
                                    <div class="form-group col-md-2 ">
                                        <input type="text" name="page" id="page" class="form-control" placeholder="تعداد نمایش">
                                    </div>
                                    <div class="form-group col-md-2 ">
                                        <button type="submit" id="btnFiterSubmitSearch" class="btn btn-default btnFiterSubmitSearch">اعمال فیلتر</button>
                                    </div>

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
                                                <th class="wd-10p"> شماره موبایل2 </th>
                                                <th class="wd-10p"> حامی یاب </th>
                                                <th class="wd-10p"> تعداد واریزی </th>
                                                <th class="wd-10p"> توضیحات </th>
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
                    {
                        extend: 'colvis',
                        text: 'انتخاب فیلد',
                        className: 'btn btn-default btn-xs',
                        footer: true,
                    },

                ],
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': true
                    }
                ],
                "lengthChange": true,
                {{--"pageLength": {{$page}},--}}
                processing: true,
                serverSide: true,
                orderable: true,
                searching: false,
                paging: false,
                searchable: false,
                fixedHeader: false,
                orderCellsTop: false,
                ajax:{
                    url:"{{ route('siteusers.index') }}",
                    type: 'GET',
                    data: function (d) {
                        d.user_id     = $('#user_id').val();
                        d.name        = $('#name').val();
                        d.page        = $('#page').val();
                        d.total       = $('#total').val();
                        d.mobile      = $('#mobile').val();
                        d.hamiyab     = $('#hamiyab').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex'    , name: 'DT_RowIndex'   },
                    {data: 'id'             , name: 'id'            },
                    {data: 'name'           , name: 'name'          },
                    {data: 'mobile'         , name: 'mobile'        },
                    {data: 'mobile2'        , name: 'mobile2'       },
                    {data: 'username'       , name: 'username'      },
                    {data: 'countdeposit'   , name: 'countdeposit'  },
                    {data: 'description'    , name: 'description'   },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        });
        $('#btnFiterSubmitSearch').click(function(){
            $('.yajra-datatable').DataTable().draw(true);
        });
        $(document).ready(function() {
            table.buttons().container()
                .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
        });

        var detailRows = [];

        $('.yajra-datatable tbody').on('click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row(tr);
            var idx = detailRows.indexOf(tr.attr('id'));

            if (row.child.isShown()) {
                tr.removeClass('details');
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice(idx, 1);
            } else {
                tr.addClass('details');
                row.child(format(row.data())).show();

                // Add to the 'open' array
                if (idx === -1) {
                    detailRows.push(tr.attr('id'));
                }
            }
        });

        // On each draw, loop over the `detailRows` array and show any child rows
        dt.on('draw', function () {
            detailRows.forEach(function(id, i) {
                $('#' + id + ' td.details-control').trigger('click');
            });
        });
    </script>
@endsection
