@extends('client.templates.layout')
@section('content')
    <header class="single-header">
        <!-- Start: Header Content -->
     <div class="container">
        <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-sm-12">
                <!-- Headline Goes Here -->
                <h3>Signup Form</h3>
                <h4><a href="index-2.html"> Home </a> <span> &vert; </span> Signup </h4>
            </div>
        </div>
        <!-- End: .row -->
    </div>
    <!-- End: Header Content -->
    </header>
    <section class="account-section">
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <div class="reg_wrap">--}}
{{--                        <!-- Start: Image -->--}}
{{--                        <div class="reg_img">--}}
{{--                            <img src="{{asset('client/images/hero-men.png')}}" alt="">--}}
{{--                        </div>--}}
{{--                        <?php //Hiển thị thông báo thành công?>--}}
{{--                        @if ( Session::has('success') )--}}
{{--                            <div class="alert alert-success alert-dismissible" role="alert">--}}
{{--                                <strong>{{ Session::get('success') }}</strong>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                    <span class="sr-only">Close</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        <?php //Hiển thị thông báo lỗi?>--}}
{{--                        @if ( Session::has('error') )--}}
{{--                            <div class="alert alert-danger alert-dismissible" role="alert">--}}
{{--                                <strong>{{ Session::get('error') }}</strong>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                    <span class="sr-only">Close</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        @if ($errors->any())--}}
{{--                            <div class="alert alert-danger alert-dismissible" role="alert">--}}
{{--                                <ul>--}}
{{--                                    @foreach ($errors->all() as $error)--}}
{{--                                        <li>{{ $error }}</li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                    <span class="sr-only">Close</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                    @endif--}}
{{--                     {{dd($list)}}--}}
{{--                     {{$list[0]->ten_khoahoc}}--}}
{{--                    <!-- Start:  Signup  Form  -->--}}
{{--                        <div class="registration-form">--}}
{{--                            <h2> Đăng ký Khóa Học! </h2>--}}

{{--                            <form method="post" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                <div class="row">--}}
{{--                                    <input type="text" name="user_id" id="" value="{{Auth::user()->id??""}}" hidden>--}}
{{--                                    <input class="signup-field" name="gia_khoa_hoc" id="gia_khoa_hoc" type="text" value="{{isset($giaKhoaHoc) ? $giaKhoaHoc: ""}}" hidden>--}}
{{--                                    <div class="col-md-6 col-sm-12">--}}
{{--                                        <label for="">Tên</label>--}}
{{--                                        <input class="signup-field" value="" name="name" id="name" type="text"--}}
{{--                                               placeholder="Tên">--}}
{{--                                        @error('name')--}}
{{--                                        <div class="text-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6 col-sm-12">--}}
{{--                                        <label for="">Email</label>--}}
{{--                                        <input class="signup-field" value="" name="email" id="name" type="text"--}}
{{--                                               placeholder="Email">--}}
{{--                                        @error('email')--}}
{{--                                        <div class="text-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6 col-sm-12">--}}
{{--                                        <label for="">Địa chỉ</label>--}}
{{--                                        <input class="signup-field" value="" name="dia_chi" id="name" type="text"--}}
{{--                                               placeholder="Địa chỉ">--}}
{{--                                        @error('dia_chi')--}}
{{--                                        <div class="text-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6 col-sm-12">--}}
{{--                                        <label for="">Số điện thoại</label>--}}
{{--                                        <input class="signup-field" name="sdt" value="" id="name" type="text"--}}
{{--                                               placeholder="Số điện thoại">--}}
{{--                                        @error('sdt')--}}
{{--                                        <div class="text-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 col-sm-12">--}}
{{--                                        <label for="">Tên khóa học</label>--}}
{{--                                        <select class="form-control" name="id_khoa_hoc" id="id_khoahoc" data-url="{{route('client_dang_ky')}}" >--}}
{{--                                            <option>-- Chọn khóa học --</option>--}}
{{--                                            @foreach ($listKhoaHoc as $item)--}}
{{--                                                <option  value="{{ $item->id }}" {{$item->id == isset($idKhoaHoc) ? "selected" :""}}>{{ $item->ten_khoa_hoc }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                         @error('ten_khoahoc')--}}
{{--                                      <div class="text-danger">{{$message}}</div>--}}
{{--                                  @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 col-sm-12">--}}
{{--                                        <label for="">Tên lớp</label>--}}
{{--                                        <select class="form-control" name="id_lop" id="id_lop" >--}}
{{--                                            <option>--Chọn Lớp--</option>--}}
{{--                                            @if(isset($listLop) && $listLop->count()>0)--}}
{{--                                                @foreach($listLop as $lop)--}}
{{--                                                    <option value="{{$lop->id}}" {{$lop->id == $idLop ? "selected" : ""}}>{{$lop->ten_lop}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 col-sm-12">--}}
{{--                                        <label for="">Giá</label>--}}
{{--                                        <input class="signup-field" name=""  id="id_gia" type="text" value="{{isset($giaKhoaHoc) ? $giaKhoaHoc: ""}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <div class="term-and-condition">--}}
{{--                                            <input type="checkbox" id="term">--}}
{{--                                            <label for="term">I agree to <a href="#">term &amp; condition</a> and <a--}}
{{--                                                    href="#">privacy policy</a></label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-12 submit-area">--}}
{{--                                        <button class="submit more-link" type="submit">Đăng ký học</button>--}}
{{--                                        <div id="msg" class="message"></div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <!-- End:Signup Form  -->--}}
{{--                    </div>--}}
{{--                    <!-- .col-md-6 .col-sm-12 /- -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- row /- -->--}}
{{--        </div>--}}
        <!-- container /- -->
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
{{--            {{dd($loadDangKy)}}--}}
            <div class="row">
                <div class="col-3 border rounded">
                    <div class="col-12 p-3">
                        <h3>Thông tin đăng ký</h3>
                    </div>
                    <div class="col-12 pt-2" >
                        <label class="text-lg" style="padding-left: 13px;">Tên khóa học: </label>
                        <span style="font-size: 18px;color: red">{{$loadDangKy->ten_khoa_hoc}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-lg" style="padding-left: 13px;">Tên lớp học: </label>
                        <span style="font-size: 18px;color: red">{{$loadDangKy->ten_khoa_hoc}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-lg" style="padding-left: 13px;">Ca học:</label>
                        <span style="font-size: 18px;color: red">{{$loadDangKy->id_ca_hoc}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-lg" style="padding-left: 13px;">Giảng viên:</label>
                        <span style="font-size: 18px;color: red">{{$loadDangKy->id_giang_vien}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-lg" style="padding-left: 13px;">Ngày khai giảng:</label>
                        <span style="font-size: 18px;color: red"> {{$loadDangKy->ngay_bat_dau}}</span>
                    </div>
                    <div class="col-12 pt-2">
                        <label class="text-lg" style="padding-left: 13px;">Số lượng:</label>
                        <span style="font-size: 18px;color: red"> {{$loadDangKy->so_luong}}</span>
                    </div>

                    <div class="col-12 p-3">
                        <label class="text-lg text-danger" >Học phí:</label>
                        <h3>{{$loadDangKy->gia_khoa_hoc}} VND</h3>
                    </div>
                </div>

                <div class="row col border rounded" style="margin-left: 10px">
                    <div class="col-12 p-3">
                        <h3>Thông tin cá nhân</h3>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="text" name="user_id" id="" value="{{Auth::user()->id??""}}" hidden>
                            <input type="text" name="lop_id" id="" value="{{isset($loadDangKy->id) ? ($loadDangKy->id): "" }}" hidden>
                            <input type="text" name="gia_khoa_hoc" id="" value="{{isset($loadDangKy->gia_khoa_hoc) ? ($loadDangKy->gia_khoa_hoc): "" }}" hidden>
                            <div class="col-md-6 col-sm-12">
                                <label class="signup-field">Họ Tên</label>
                                <input style="margin: 10px;height: 50px" value="{{Auth::user()->name??''}}" class="form-control" name="name" type="text" placeholder="Họ Tên">
                                @error('name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label class="signup-field">Email</label>
                                <input style="margin: 10px;height: 50px" value="{{Auth::user()->email??''}}" class="form-control" name="email" type="text" placeholder="Email">
                                @error('email')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
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
                                <label class="signup-field">Chọn phương thức thanh toán</label>
                                @foreach($payment_method as $method)
                                    <div>
                                        <input name="ten" type="radio" id="{{$method->id}}" value="{{$method->id}}" hidden>
                                        <label for="{{$method->id}}" class="btn btn-primary btn-thanh-toan" id="{{$method->id}}" name="ten">{{$method->ten}}</label>
                                    </div>
                                @endforeach
                                <form id="form-vnpay" class="d-none" action="{{route('payment',[$loadDangKy->id])}}" method="post">
                                    @csrf
                                    <input type="text" name="gia_khoa_hoc" value="{{$loadDangKy->gia_khoa_hoc}}" hidden>
                                    <input type="text" name="id" value="{{$loadDangKy->id}}" hidden>
                                    <div class="form-group">
                                        <button type="submit" id="btn-payment" name="redirect" class="btn btn-dark btm-md full-width">Thanh Toán VNPAY</button>
                                    </div>
                                </form>
                            </div>

{{--                            <div class="col-12 p-3">--}}
{{--                                <label class="text-lg">Hình thức thanh toán</label>--}}

{{--                            </div>--}}

                            <div class="col-6 p-3">
                                <button class="btn btn-primary" type="submit" >Xác nhận</button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('click','.btn-thanh-toan',function (e) {
                const
            })
        })
    </script>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#id_khoahoc', function (event) {
                const url = $(this).data('url')
                const data = $(this).val();
                console.log(url, data);
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        id_khoahoc: data
                    },
                    success: function (res) {
                        console.log(res)
                        let htmls="<option>--Chọn Lớp--</option>"
                        let ten_lop=Object.values(res.lop);
                        console.log(res.lop);
                        ten_lop.forEach(function (item) {
                            console.log(item)
                            htmls+=` <option  value="${ item.id }">${ item.ten_lop }</option>`
                        })
                        $('#id_gia').val(res.gia_khoa_hoc)
                        $('#gia_khoa_hoc').val(res.gia_khoa_hoc)
                        $('#id_lop').html(htmls)
                    }
                })
            })
        })
    </script>
@endsection

