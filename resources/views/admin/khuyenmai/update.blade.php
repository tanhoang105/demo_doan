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
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6">Cập nhập thông tin khuyến mãi</h3>
            </div>
            <form action="{{route('route_BE_Admin_Update_Khuyen_Mai',$coupon->id)}}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $coupon->id }}" id="id">
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label" for="name">Loại mã giảm giá</label>
                        <div class="col-lg-9">
                            <select name="loai_khuyen_mai" id="coupon_type" class="form-control aiz-selectpicker" onchange="coupon_form()" required>
                                @if ($coupon->loai_khuyen_mai == 1)
                                    <option value="1" selected>Đối với khóa học</option>
                                @elseif ($coupon->loai_khuyen_mai == 2)
                                    <option value="2">Đối với tất cả khóa học</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div id="coupon_form">


                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
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
            console.log(coupon_type);
            var id = $('#id').val();
            $.get('{{ route('route_BE_Admin_Khuyen_mai_form_edit') }}',{coupon_type:coupon_type, id:id}, function(data){
                console.log(id)
                $('#coupon_form').html(data);

                //    $('#demo-dp-range .input-daterange').datepicker({
                //        startDate: '-0d',
                //        todayBtn: "linked",
                //        autoclose: true,
                //        todayHighlight: true
                // });
            });
        }

        $(document).ready(function(){
            coupon_form();
        });


    </script>

@endsection
