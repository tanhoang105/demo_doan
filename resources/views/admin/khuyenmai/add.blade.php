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
    <div class="mx-auto">
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
