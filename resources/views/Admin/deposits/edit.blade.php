@extends('Admin.admin')
@section('title')
    <title> ویرایش کاربران سایت</title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css-rtl/colors/default.css')}}" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کاربران سایت</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/siteusers')}}"> مدیریت کاربران سایت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش کاربران سایت</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            @foreach($deposits as $deposit)
                                <div class="card-body">
                                    <div>
                                        <h6 class="main-content-label text-center mb-5">ویرایش اطلاعات کاربران سایت</h6>
                                    </div>

                                    <form action="{{ route('deposits.update', $deposit->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{ method_field('PATCH') }}
                                        <div class="row row-sm">
                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام و نام خانوادگی</p>
                                                    <select name="user_id" required class="form-control select-lg select2" id="user_id">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}" {{$deposit->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تاریخ واریز</p>
                                                    <input type="text" name="date" required class="form-control fc-datepicker" value="{{$deposit->date}}" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <p class="mg-b-10">مبلغ واریز</p>
                                                    <input type="text" name="amount" required value="{{number_format($deposit->amount)}}" class="form-control loan_max_amount" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">علت واریز</p>
                                                <select name="reason_id" required class="form-control select-lg select2">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($reasons as $reason)
                                                        <option value="{{$reason->id}}" {{$reason->id == $deposit->reason_id ? 'selected' : ''}}>{{$reason->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <p class="mg-b-10">شماره کارت</p>
                                                    <select name="acountnumber_id" class="form-control select-lg select2" id="acountnumber_id">
                                                        @foreach($acountnumbers as $acountnumber)
                                                            <option value="{{$acountnumber->id}}" {{$acountnumber->id == $deposit->acountnumber_id ? 'selected' : ''}}>{{$acountnumber->title}} - {{$acountnumber->shomare_hesab}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mg-b-10 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('end')
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <script src="{{asset('admin/assets/js/form-elements.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.3/dist/cleave.min.js"></script>

    <script>
        document.querySelectorAll('.loan_max_amount').forEach(inp => new Cleave(inp, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        }));
    </script>
    <script>
        $(function(){
            $('#user_id').change(function(){
                $("#acountnumber_id option").remove();
                var id = $('#user_id').val();

                $.ajax({
                    url : '{{ route( 'acountnumber' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function( result )
                    {
                        $.each( result, function(k, v) {
                            $('#acountnumber_id').append($('<option>', {value:k, text:v}));
                        });
                    },
                    error: function()
                    {
                        //handle errors
                        alert('error...');
                    }
                });
            });
        });
    </script>

@endsection

