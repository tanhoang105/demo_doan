@extends('client.templates.layout')
@section('content')
    <header class="single-header">
        <!-- Start: Header Content -->
     <div class="container">
        <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-sm-12">
                <!-- Headline Goes Here -->
                <h3>Đăng ký khóa học</h3>
                <h4><a href="/"> Trang chủ </a> <span> &vert; </span> Đăng ký </h4>
            </div>
        </div>
        <!-- End: .row -->
    </div>
    <!-- End: Header Content -->
    </header>
    <section class="account-section">
        <div class="container">
                <?php //Hiển thị thông báo thành công?>
            @if ( Session::has('success') )
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif
                <?php //Hiển thị thông báo lỗi?>
            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif
            <div class="alert alert-danger alert-dismissible d-none" role="alert">
                <strong>Bạn đã đăng ký khóa học hoặc đã trùng ca này !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif
                <div> </div>
           {{-- {{dd($loadDangKy)}} --}}
            <div class="row">
                <div class="col-3 border rounded">
                    <div class="col-12 p-3">
                        <h3>Thông tin đăng ký</h3>
                    </div>
                    <div class="col-12 pt-2" >
                        <label class="text-dark" style="padding-left: 13px;">Tên khóa học: </label>
                        <span style="font-size: 15px;color: red">{{$loadDangKy->ten_khoa_hoc}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-dark" style="padding-left: 13px;">Tên lớp học: </label>
                        <span style="font-size: 15px;color: red">{{$loadDangKy->ten_lop}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-dark" style="padding-left: 13px;">Ca học:</label>
                        @foreach($layThu as $thu)
                        <span style="font-size: 15px;color: red">{{$thu->ten_thu}}</span>
                        @endforeach
                        {{-- <br> --}}
                        <div style="margin-left: 12px;font-size: 15px;color: red"> {{$loadDangKy->ca_hoc .' từ '. $loadDangKy->thoi_gian_bat_dau . ' đến ' . $loadDangKy->thoi_gian_ket_thuc}}</div>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-dark" style="padding-left: 13px;">Giảng viên:</label>
                        <span style="font-size: 15px;color: red">{{$loadDangKy->ten_giang_vien}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-dark" style="padding-left: 13px;">Ngày khai giảng:</label>
                        <span style="font-size: 15px;color: red"> {{$loadDangKy->ngay_bat_dau}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-dark text-justify" style="padding-left: 13px;">Số lượng:</label>
                        <span style="font-size: 15px;color: red"> {{$loadDangKy->so_luong}}</span>
                    </div>
                    <div class="col-12 p-3">
                        <label class=" text-danger" >Học phí:</label>
                        <h3 id="gia_kh">{{number_format($loadDangKy->gia_khoa_hoc)}} VNĐ</h3>
                    </div>
                    <div class="col-12">
                        <label  class="text-justify" id="khuyen_mai" style="padding-left: 13px;font-size: 15px;color: red"></label>
                    </div>
                    <div style="padding-left: 13px;">
                        <input class="form-control coupon-value"  placeholder="Nhập mã khuyến mại ..."/> 
                        <button class="btn btn-danger btn-sm mt-2 mb-4 rounded btn-apply" data-url="{{route('apply_coupon')}}">Áp dụng</button>
                    </div>
                    
                </div>

                <div class="row col border rounded" style="margin-left: 10px">
                    <div class="col-12 p-3">
                        <h3>Thông tin cá nhân</h3>
                    </div>
                    {{-- {{dd($loadDangKy);}} --}}
                    <form method="post" action="{{route('client_post_dang_ky',$loadDangKy->id)}}" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="row">
                            {{-- {{dd($loadDangKy)}}; --}}
                            <input type="text" name="khuyen_mai_id" id="khuyen_mai_id" hidden>
                            <input type="text" name="user_id" id="" value="{{Auth::user()->id??""}}" hidden>
                            <input type="text" name="lop_id" id="" value="{{isset($loadDangKy->id) ? ($loadDangKy->id): "" }}" hidden>
                            <input type="text" name="thu_hoc_id" id="" value="{{isset($loadDangKy->thu_hoc_id) ? ($loadDangKy->thu_hoc_id): "" }}" hidden>
                            <input type="text" name="ca_id" id="" value="{{isset($loadDangKy->ca_id) ? ($loadDangKy->ca_id): "" }}" hidden>
                            <input type="text" name="id_khoa_hoc" id="id_khoa_hoc" hidden value="{{isset($loadDangKy->id_khoa_hoc) ? ($loadDangKy->id_khoa_hoc): "" }}">
                            <input type="text" name="gia_khoa_hoc" id="gia_khoa_hoc"  value="{{isset($loadDangKy->gia_khoa_hoc) ? ($loadDangKy->gia_khoa_hoc): "" }}" hidden>

                            <div class="col-md-6 col-sm-12">
                                <label class="signup-field">Họ Tên</label>
                                <input style="margin: 10px;height: 50px" value="{{Auth::user()->name??''}}" class="form-control" name="name" type="text" placeholder="Họ Tên">
                                @error('name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label class="signup-field">Email</label>
                                <input style="margin: 10px;height: 50px" data-url="{{route('client_check_email')}}" value="{{Auth::user()->email??''}}" class="form-control" id="email" name="email" type="text" placeholder="Email">
                                @error('email')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                                <div class="text-danger error_email"></div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label class="signup-field">Số điện thoại</label>
                                <input style="margin: 10px;height: 50px" class="form-control" value="{{Auth::user()->sdt??''}}" name="sdt" type="text" placeholder="Số điện thoại">
                                @error('sdt')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label class="signup-field">Địa chỉ</label>
                                <input style="margin: 10px;height: 50px" class="form-control" value="{{Auth::user()->dia_chi??''}}" name="dia_chi" type="text" placeholder="Địa chỉ">
                                @error('dia_chi')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                {{-- <label class="signup-field">Chọn phương thức thanh toán</label> --}}
                                {{-- {{dd($paymeny_method)}} --}}
                                <select style="margin: 10px;height: 50px" class="form-control" name="ten" id="select_payment">
                                @foreach($payment_method as $method)
                                    <option value=" {{$method->id}} "> {{{$method->ten}}} </option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                    </form>
                    <div class="col-6 p-3">
                        <button class="btn btn-primary" data-url="{{route('client_post_dang_ky',$loadDangKy->id)}}" id="submit" type="button">Xác nhận</button>
                    </div>

                    <form action="" method="post" id="form-payment" hidden>
                        @csrf
                        <input type="text" name="gia_khoa_hoc_payment" id="gia_khoa_hoc_payment" >
                        <input type="text" name="id" id="id_dang_ky" >
                        <input type="text"  id="" name="redirect">
                       
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

            $('#submit').on('click',function(e) {
                let payment = $('#select_payment').val();
                let url = $(this).data('url')
                if(payment == 1) {
                    $('#form').submit();
                }else{
                    let data = $('#form').serialize();
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: data,
                        success: function(res) {
                            if(res.success == true){
                            $('#gia_khoa_hoc_payment').val(res.gia_khoa_hoc);
                            $('#id_dang_ky').val(res.id_dang_ky);
                            $('#form-payment').attr('action',`/vnp_payment/${res.id_dang_ky}`)
                            $('#form-payment').submit();
                            }
                            else{
                                $('.alert.d-none').removeClass('d-none')
                            }

                        }
                    })
                }

            })
            
            let checkEmail=false;
            $('#email').blur(function () {
                let email=$(this).val();
                let url=$(this).data('url');
                $.ajax({
                    type:'GET',
                    url :url,
                    data:{
                        email:email,
                    },
                    success:function (res) {
                        if(res['status']==200){
                            checkEmail=true;
                            $('.error_email').html('')
                            $('#submit').attr('disabled',false)
                        }
                        else {
                            checkEmail=false;
                            $('.error_email').html('Email này đã đăng ký tài khoản')
                            $('#submit').attr('disabled',true)
                        }
                    }

                })

            })
            let gia_khoa_hoc_old = $('#gia_khoa_hoc').val()

            $('.btn-apply').on('click',function() {
                let couponValue = $('.coupon-value').val();
                let id_khoa_hoc = $('#id_khoa_hoc').val();
                let gia_khoa_hoc = gia_khoa_hoc_old;
                // let url = $('#id_khoa_hoc')
                if(couponValue != '') {
                    $.get(
                        '{{ route('apply_coupon') }}',
                        {
                            ma_khuyen_mai:couponValue,
                            id_khoa_hoc: id_khoa_hoc,
                            gia_khoa_hoc: gia_khoa_hoc 
                        }, 
                        function(data){
                            console.log(data.loai_giam_gia);
                            $('#khuyen_mai_id').val(data.id_km);
                            if(data.success) {
                                let gia = data.gia_khoa_hoc.toLocaleString();
                                $('#gia_kh').html(gia + ' VNĐ');
                                $('#gia_khoa_hoc').val(data.gia_khoa_hoc);
                                if(data.loai_giam_gia == 1){
                                    $('#khuyen_mai').html('Giảm giá ' + data.giam_gia + ' VNĐ')
                                    alert('Áp dụng mã giảm giá thành công')
                                }
                                else{
                                    $('#khuyen_mai').html('Giảm giá ' + data.giam_gia + '%')
                                    alert('Áp dụng mã giảm giá thành công') 
                                }
                            }else {
                                alert(data.msg);
                            }
                    });
                }else {
                    alert('Vui lòng nhập mã khuyến mãi')
                }
            })

        })
    </script>
@endsection
{{--@section('js')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $(document).on('click','.btn-thanh-toan',function (e) {--}}
{{--                const--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
{{--@endsection--}}
{{--@section('js')--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $(document).on('change', '#id_khoahoc', function (event) {--}}
{{--                const url = $(this).data('url')--}}
{{--                const data = $(this).val();--}}
{{--                console.log(url, data);--}}
{{--                $.ajax({--}}
{{--                    type: 'GET',--}}
{{--                    url: url,--}}
{{--                    data: {--}}
{{--                        id_khoahoc: data--}}
{{--                    },--}}
{{--                    success: function (res) {--}}
{{--                        console.log(res)--}}
{{--                        let htmls="<option>--Chọn Lớp--</option>"--}}
{{--                        let ten_lop=Object.values(res.lop);--}}
{{--                        console.log(res.lop);--}}
{{--                        ten_lop.forEach(function (item) {--}}
{{--                            console.log(item)--}}
{{--                            htmls+=` <option  value="${ item.id }">${ item.ten_lop }</option>`--}}
{{--                        })--}}
{{--                        $('#id_gia').val(res.gia_khoa_hoc)--}}
{{--                        $('#gia_khoa_hoc').val(res.gia_khoa_hoc)--}}
{{--                        $('#id_lop').html(htmls)--}}
{{--                    }--}}
{{--                })--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
{{--@endsection--}}

