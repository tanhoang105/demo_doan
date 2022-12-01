@extends('Admin.templates.layout')
@section('content')
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif


    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif
{{--    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Khuyen_Mai') }}" method="post" enctype="multipart/form-data">--}}
{{--        <div class="row">--}}
{{--            @csrf--}}
{{--            <div class="col-6">--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="" class="form-label">Mã khuyến mại</label>--}}
{{--                    <input value="{{ old('ma_khuyen_mai') ?? request()->ma_khuyen_mai }}" type="text"--}}
{{--                        name="ma_khuyen_mai" class="form-control" id="" aria-describedby="emailHelp">--}}
{{--                    --}}{{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
{{--                    @error('ma_khuyen_mai')--}}
{{--                        <span style="color: red"> {{ $message }} </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="" class="form-label">Loại khuyến mại</label>--}}
{{--                    <select class="form-control" name="loai_khuyen_mai" id="">--}}
{{--                        <option value="1">Giảm giá theo phần trăm</option>--}}
{{--                        <option value="0">Giảm giá theo tiền</option>--}}
{{--                    </select>--}}
{{--                    --}}{{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
{{--                    @error('loai_khuyen_mai')--}}
{{--                        <span style="color: red"> {{ $message }} </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="" class="form-label">Mô tả</label>--}}
{{--                    <textarea id="ckeditor" name="mo_ta" class="form-control"></textarea>--}}
{{--                    @error('mo_ta')--}}
{{--                        <span style="color: red"> {{ $message }} </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-6">--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="" class="form-label">Giảm giá</label>--}}
{{--                    <input value="{{ old('giam_gia') ?? request()->giam_gia }}" type="text" name="giam_gia"--}}
{{--                        class="form-control" id="" aria-describedby="emailHelp">--}}
{{--                    --}}{{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
{{--                    @error('giam_gia')--}}
{{--                        <span style="color: red"> {{ $message }} </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="" class="form-label">Ngày bắt đầu</label>--}}
{{--                    <input value="{{ old('ngay_bat_dau') ?? request()->ngay_bat_dau }}" type="date" name="ngay_bat_dau"--}}
{{--                        class="form-control" id="" aria-describedby="emailHelp">--}}
{{--                    --}}{{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
{{--                    @error('ngay_bat_dau')--}}
{{--                        <span style="color: red"> {{ $message }} </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="" class="form-label">Ngày kết thúc</label>--}}
{{--                    <input value="{{ old('ngay_ket_thuc') ?? request()->ngay_ket_thuc }}" type="date"--}}
{{--                        name="ngay_ket_thuc" class="form-control" id="" aria-describedby="emailHelp">--}}
{{--                    --}}{{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
{{--                    @error('ngay_ket_thuc')--}}
{{--                        <span style="color: red"> {{ $message }} </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-primary">Thêm</button>--}}

{{--    </form>--}}
    {{-- <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script> --}}
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Thêm thông tin mã giảm giá</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('route_BE_Admin_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label" for="name">Loại khuyến mãi</label>
                        <div class="col-lg-9">
                            <select name="loai_khuyen_mai" id="coupon_type" class="form-control aiz-selectpicker" onchange="coupon_form()" required>
                                <option value="">Chọn loại khuyến mãi</option>
                                <option value="1">Đối với khóa học</option>
                                <option value="2">Đối với tất cả khóa học</option>
                            </select>
                        </div>
                    </div>

                    <div id="coupon_form">

                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

    <script type="text/javascript">

        function coupon_form(){
            var coupon_type = $('#coupon_type').val();
            console.log(12123);
            $.get('{{ route('route_BE_Admin_Coupon_Form') }}',{ coupon_type:coupon_type}, function(data){
                console.log(data);
                $('#coupon_form').html(data);

                //    $('#demo-dp-range .input-daterange').datepicker({
                //        startDate: '-0d',
                //        todayBtn: "linked",
                //        autoclose: true,
                //        todayHighlight: true
                // });
            });
        }

    </script>

@endsection
