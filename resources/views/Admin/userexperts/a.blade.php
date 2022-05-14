<!-- begin::page-header -->
@extends('dashboard.keramat.layouts.main')
@section('style')

    <link rel="stylesheet" href="{{asset('dashboard/keramat/vendors/dataTable/v1/css/semantic.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('dashboard/keramat/vendors/dataTable/v1/css/dataTables.semanticui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('dashboard/keramat/vendors/dataTable/v1/css/buttons.semanticui.min.css')}}" type="text/css">
    <style>
        body {
            margin: 0 !important;
            font-family:iransans-light !important;
            font-size: 1rem !important;
            font-weight: 400 !important;
            line-height: 1.5 !important;
            position: relative;
            background: #f1f2f7;
            color: #505050;
            direction: rtl;
            text-align: right;
        }
        h4
        {
            font-family:iransans-light !important;

        }
        .dt-button
        {
            font-family:iransans-light !important;
        }
        table.dataTable.table thead th.sorting, table.dataTable.table thead th.sorting_asc, table.dataTable.table thead th.sorting_desc, table.dataTable.table thead td.sorting, table.dataTable.table thead td.sorting_asc, table.dataTable.table thead td.sorting_desc {
            padding-right: 31px;
        }

        .table td, .table th {
            padding: .75rem 1.15rem;
            text-align: right !important;
        }
        .ui.table>thead>tr>th
        {
            background: #ced4da !important;
        }
        ul li .active
        {
            text-align: right;
        }
        ul li a
        {
            text-align: right;
        }
        table#sample1.dataTable tbody tr:hover {
            background-color: #ecdc4d52;
        }
        .table th input
        {
            border: 1.5px solid #8a8686;
            padding: 5px;
            border-radius: 8px;
        }
        .paginate_button
        {
            font-family:iransans-light !important;
        }

        #sample1_filter {
            display: none;
        }
        .dataTables_info
        {
            margin-top: 20px;
        }
        .dataTables_paginate
        {
            margin-top: 20px;
        }
        .dt-print-view
        {
            overflow-x: unset !important;
            direction: rtl !important;
        }
        .dt-buttons
        {
            float: left;
            margin-bottom: 12px !important;
        }
        .page-card
        {
            position: absolute;
            top: 3.5%;
            right: 3%;
            z-index: 999;
        }
        .ui.button
        {
            padding: 0.6em 1em 0.6em !important;
        }
        table.dataTable.table thead th.sorting:after, table.dataTable.table thead th.sorting_asc:after, table.dataTable.table thead th.sorting_desc:after, table.dataTable.table thead td.sorting:after, table.dataTable.table thead td.sorting_asc:after, table.dataTable.table thead td.sorting_desc:after{
            content: none !important;
        }
        .thead-datatable {
            background: #b6c7d2e3 !important;
        }
    </style>
@endsection
@section('content')

    <!-- Javascript -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>مدیریت کاربران</h4>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="page-card">
                        <div class="row">
                            <form method="get" action="{{ route('hotelLogDecreaseQuataRoute') }}" style="display: flex">
                                <input type="number" class="form-control" name="page" value="{{$page}}" autocomplete="off" style="width: 100px">
                                <button type="submit" class="dt-button ui button buttons-copy buttons-html5"><i class="fa fa-refresh"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="sample1" class="table table-striped table-bordered data-table">
                                <thead class="thead-datatable">
                                <tr>
                                    <th>عملیات</th>
                                    <th>#</th>
                                    <th>نام کاربری</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>محل خدمت</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ایجاد شده</th>
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


@endsection
@section('js')

    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/semantic.min.js')}}"></script>
    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/dataTables.semanticui.min.js')}}"></script>
    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/buttons.semanticui.min.js')}}"></script>
    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/jszip.min.js')}}"></script>
    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/vfs_fonts.js')}}"></script>
    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/buttons.html5.min.js')}}"></script>
    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/buttons.print.min.js')}}"></script>
    <script src="{{asset('dashboard/keramat/vendors/dataTable/v1/buttons.colVis.min.js')}}"></script>
    <script>
        $('#sample1 thead tr').clone(true).appendTo('#sample1 thead');
        $('#sample1 thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="جستجوی ' + title + '" />');

            $('input', this).on('change change', function () {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        var table = $('#sample1').DataTable({
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
            order: [[ 1, 'asc' ]],
            dom: 'Bfrtip',
            buttons: [
                    @if (in_array('/panel/manageuser/add', $access))
                {
                    text: 'افزودن کاربر',
                    action: function () {
                        location.href = "{{route('manageUserAdd')}}";
                    }
                },
                    @endif
                {
                    text: 'بروز رسانی جدول',
                    action: function () {
                        table.ajax.reload();
                    }
                },
                {
                    extend: 'excel',
                    text: 'اکسل',
                    className: 'btn btn-default btn-xs'
                },
                {
                    extend: 'print',
                    text: 'پرینت و pdf',
                    className: 'btn btn-default btn-xs'
                },
                {
                    extend: 'copy',
                    text: 'کپی',
                    copySuccess: {
                        1: "کپی با موفقیت انجام شد",
                        _: "کپی %d رکورد ثبت شد"
                    },
                    copyTitle: 'کپی با موفقیت انجام شد',
                    className: 'btn btn-default btn-xs'
                },
                {
                    extend: 'colvis',
                    text: 'فیلتر ستون ها',
                    className: 'btn btn-default btn-xs'
                }

            ],
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': true
                }
            ],
            "lengthChange": true,
            "pageLength": '{{$page}}',
            fixedHeader: false,
            orderCellsTop: true,
            serverSide: true,
            scrollY:500,
            scrollx:true,
            "scrollX": true,
            ajax: "{{ route('manageUserList') }}",
            columns: [
                {data: 'action', name: 'action'},
                {data: 'id', name: 'u.id'},
                {data: 'username', name: 'u.username'},
                {data: 'name', name: 'u.name'},
                {data: 'family', name: 'u.family'},
                {data: 'service_location', name: 'sl.name'},
                {data: 'status', name: 'u.status'},
                {data: 'created_at', name: 'u.created_at'}
            ],
        });


        $(document).ready(function() {
            table.buttons().container()
                .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
        });


    </script>

@endsection
