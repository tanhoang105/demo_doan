@extends('client.templates.layout')
@section('content')
    <header class="single-header">
        <!-- Start: Header Content -->
     <div class="container">
        <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-sm-12">
                <!-- Headline Goes Here -->
                <h3>Đăng Ký</h3>
                <h4><a href="{{ route('home') }}"> Trang Chủ </a> <span> &vert; </span> Đăng Ký </h4>
            </div>
        </div>
        <!-- End: .row -->
    </div>
    <!-- End: Header Content -->
    </header>

    <section class="account-section">
    <div class="container">
        {{-- <?php //Hiển thị thông báo thành công?> --}}
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
            {{-- <?php //Hiển thị thông báo lỗi?> --}}
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
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
        <form method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="row col-8">
                <div class="col-12">
                    <h3>Thông tin cá nhân</h3>
                </div>

                <input type="text" name="khuyen_mai_id" id="khuyen_mai_id" hidden>
                <input type="text" name="user_id" id="" value="{{Auth::user()->id??""}}" hidden>
                <input type="text" name="lop_id" id="" value="{{isset($loadDangKy->id) ? ($loadDangKy->id): "" }}" hidden>
                <input type="text" name="thu_hoc_id" id="" value="{{isset($loadDangKy->thu_hoc_id) ? ($loadDangKy->thu_hoc_id): "" }}" hidden>                        <input type="text" name="ca_id" id="" value="{{isset($loadDangKy->ca_id) ? ($loadDangKy->ca_id): "" }}" hidden>
                <input type="text" name="id_khoa_hoc" id="id_khoa_hoc" hidden value="{{isset($loadDangKy->id_khoa_hoc) ? ($loadDangKy->id_khoa_hoc): "" }}">
                <input type="text" name="gia_khoa_hoc" id="gia_khoa_hoc"  value="{{isset($loadDangKy->gia_khoa_hoc) ? ($loadDangKy->gia_khoa_hoc): "" }}" hidden>

                <div class="col-6">
                    <label class="text-dark" style="font-size:18px;">Họ và tên</label>
                    <input style="height: 50px" class="form-control" value="{{Auth::user()->name??''}}"  name="name" 
                    type="text" placeholder="Họ và Tên">
                    @error('name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="text-dark" style="font-size:18px;">Email</label>
                    <input style="height: 50px" data-url="{{route('client_check_email')}}" value="{{Auth::user()->email??''}}" 
                    class="form-control" id="email" name="email" type="email" placeholder="Email">
                    @error('email')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="text-danger error_email"></div>
                </div>

                <div class="col-6">
                    <label class="text-dark" style="font-size:18px;">Số điện thoại</label>
                    <input style="height: 50px" class="form-control" value="{{Auth::user()->sdt??''}}" name="sdt" 
                    type="text" placeholder="Số điện thoại">
                    @error('sdt')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="text-dark" style="font-size:18px;">Địa chỉ</label>
                    <input style="height: 50px" class="form-control" value="{{Auth::user()->dia_chi??''}}" name="dia_chi" 
                    type="text" placeholder="Địa chỉ">
                    @error('dia_chi')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <h3>Hình thức thanh toán</h3>
                </div>

                <div class="col-6">
                    <label class="text-dark" style="font-size:18px;">Chọn hình thức thanh toán</label>
                    <select class="form-control" name="ten" style="height: 50px">
                        @foreach($payment_method as $method)
                            <option name="ten" id="{{$method->id}}">{{$method->ten}}</option>
                    @endforeach
                    </select>
                    
                </div>
            </div>

            {{-- <div class="col-4">
                
            </div> --}}

            <div class="col-4">
                <div class="col-12">
                    <h3>Thông tin chi tiết</h3>
                </div>

                {{-- <div class="col-12">
                    <img style="height: 70px" src="{{ Storage::url($loadDangKy->hinh_anh) }}">
                </div> --}}

                <div class="col-12 pt-2 d-flex justify-content-between" >
                    <label class="text-dark" style="font-size:18px;">Khóa học</label>
                    <span style="font-size:16px;">{{$loadDangKy->ten_khoa_hoc}}</span>
                </div>

                <div class="col-12 pt-2 d-flex justify-content-between">
                    <label class="text-dark" style="font-size:18px;">Lớp</label>
                    <span style="font-size:16px;">{{$loadDangKy->ten_lop}}</span>
                </div>

                <div class="col-12 pt-2 d-flex justify-content-between">
                    <label class="text-dark" style="font-size:18px;">Ca học</label>
                    @foreach($layThu as $thu)
                    <span style="font-size:16px;">{{$thu->ten_thu}}</span>
                    @endforeach

                    <div style="font-size:16px;"> {{$loadDangKy->ca_hoc .' - '. $loadDangKy->thoi_gian_bat_dau . ' - ' . $loadDangKy->thoi_gian_ket_thuc}}</div>
                </div>

                <div class="col-12 pt-2 d-flex justify-content-between">
                    <label class="text-dark" style="font-size:18px;">Giảng viên</label>
                    <span style="font-size:16px;">{{$loadDangKy->ten_giang_vien}}</span>
                </div>

                <div class="col-12 pt-2 d-flex justify-content-between">
                    <label class="text-dark" style="font-size:18px;">Ngày khai giảng</label>
                    <span style="font-size:16px;"> {{ date('d-m-Y', strtotime($loadDangKy->ngay_bat_dau))}}</span>
                </div>

                <div class="col-12 pt-2 d-flex justify-content-between">
                    <label class="text-dark" style="font-size:18px;">Số lượng</label>
                    <span style="font-size:16px;"> {{$loadDangKy->so_luong}}</span>
                </div>

                <div class="col-12 pt-3 d-flex justify-content-between">
                    <label class="text-lg text-dark" >Học phí:</label>
                    <span class="text-danger" style="font-size:24px" id="gia_kh">{{number_format($loadDangKy->gia_khoa_hoc,0,'.','.')}}₫</span>
                </div>

                <div class="row pt-3">
                    <div class="col-8">
                        <input class="form-control coupon-value"  placeholder="Nhập mã giảm giá" style="height: 50px"/> 
                    </div>

                    <div class="col-4 p-0">
                        <button class="btn btn-danger btn-sm mb-4 btn-apply rounded" data-url="{{route('apply_coupon')}}" style="height: 50px">Áp dụng</button>
                    </div>
                </div>

                <hr>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-primary rounded" id="submit" type="submit">Xác nhận</button>
                </div>
            </div>
        </div>
        </form>

    </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.radio_input')[0].checked = true;
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
                            console.log(data.success);
                            $('#khuyen_mai_id').val(data.id_km);
                            if(data.success) {
                                let gia = data.gia_khoa_hoc.toLocaleString();
                                $('#gia_kh').html(gia + ' VNĐ');
                                $('#gia_khoa_hoc').val(data.gia_khoa_hoc);
                                alert('Áp dụng mã giảm giá thành công');
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
