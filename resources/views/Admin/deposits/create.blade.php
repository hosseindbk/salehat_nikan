@extends('Admin.admin')
@section('title')
    <title> ایجاد واریزی</title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css-rtl/colors/default.css')}}" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت واریزی</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/deposits')}}"> مدیریت واریزی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد واریزی</li>
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
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label text-center mb-5">ورود اطلاعات منو داشبورد</h6>
                                </div>
                                <form action="{{ route('deposits.store')}}" method="POST">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">نام و نام خانوادگی</p>
                                                <select name="user_id" class="form-control select-lg select2" id="user_id">
                                                    <option value="">انتخاب کنید</option>
                                                @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">تاریخ واریز</p>
                                                <input type="text" name="date"  class="form-control fc-datepicker" placeholder="روز / ماه / سال" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">مبلغ واریز</p>
                                                <input type="text" name="amount" data-required="1" placeholder="مبلغ واریز را وارد کنید" class="form-control loan_max_amount" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">هماهنگ کننده</p>
                                                <select name="hamahang_id" class="form-control select-lg select2">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($userhamahang as $huser)
                                                        <option value="{{$huser->id}}" >{{$huser->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <p class="mg-b-10">علت واریز</p>
                                            <select name="reason_id" class="form-control select-lg select2">
                                                <option value="">انتخاب کنید</option>
                                                @foreach($reasons as $reason)
                                                    <option value="{{$reason->id}}">{{$reason->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">شماره کارت</p>
                                                <select name="acountnumber_id" class="form-control select-lg select2" id="acountnumber_id">
                                                    <option value="">انتخاب کنید</option>
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
