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
                <form class="form-horizontal" id="form_submit" action="{{ route('route_BE_Admin_store') }}" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-submit btn-primary">Thêm</button>
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
            });
        }

        function changeCouponType() {
            $(".input_coupon_type").val('');
            console.log(2123113);
        }
   
       
    $(document).ready(function(){
        // $('.select_coupon_type').change(function(){
        //     $(".input_coupon_type").val('');
        // })
        $('.btn-submit').click(function(e) {
            let error = false;
            e.preventDefault();
            $('.input').each(function() {
                let value = $(this).val();
                let nameInput = $(this).data('name');
                if(value == '') {
                    error = true;
                    $(this).parent().find('.msg_error').html(nameInput + ' bắt buộc nhập');
                }else{
                    if($(this).attr('name') == 'giam_gia') {
                        if($('.select_coupon_type').val() == 2 && (value <= 0 || value > 100)) {
                            error = true;
                            $('.input_coupon_type').parent().find('.msg_error').html('Phần trăm phải lớn hơn 0 và nhỏ hơn 100');
                        }else if($('.select_coupon_type').val() == 1 && value <= 0) {
                            error = true;
                            $('.input_coupon_type').parent().find('.msg_error').html('Số tiền phải lớn hơn 0 ');
                        }else {
                            $('.input_coupon_type').parent().find('.msg_error').html('');
                        }
                    }else if($(this).attr('name') == 'so_luong' ) {
                        if($(this).val() <= 0) {
                            error = true;
                            $(this).parent().find('.msg_error').html('Số lượng phải lớn hơn 0');
                        }else{
                            $(this).parent().find('.msg_error').html('');
                        }
                    }else {
                        $(this).parent().find('.msg_error').html('');

                    }
                }
            })

            if($('.chosen-select')) {
                if($('.chosen-select').val() == '') {
                    error = true;
                    $('.chosen-select').parent().find('.msg_error').html('Khóa học bắt buộc chọn');
                }else {
                    $('.chosen-select').parent().find('.msg_error').html('');
                }
            }

            if(!error) {
                $('#form_submit').submit();
            }

        })
    })

    </script>

@endsection
