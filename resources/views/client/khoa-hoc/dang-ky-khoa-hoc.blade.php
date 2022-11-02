@extends('client.templates.layout')
@section('content')
    <header class="single-header">
        <!-- Start: Header Content -->
    {{-- <div class="container">
        <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-sm-12">
                <!-- Headline Goes Here -->
                <h3>Signup Form</h3>
                <h4><a href="index-2.html"> Home </a> <span> &vert; </span> Signup </h4>
            </div>
        </div>
        <!-- End: .row -->
    </div> --}}
    <!-- End: Header Content -->
    </header>
    <section class="account-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="reg_wrap">
                        <!-- Start: Image -->
                        <div class="reg_img">
                            <img src="{{asset('client/images/hero-men.png')}}" alt="">
                        </div>
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
                    {{-- {{dd($list)}} --}}
                    {{-- {{$list[0]->ten_khoahoc}} --}}
                    <!-- Start:  Signup  Form  -->
                        <div class="registration-form">
                            <h2> Đăng ký Khóa Học! </h2>
                            <form method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="text" name="id_user" id="" value="" hidden>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="">Tên</label>
                                        <input class="signup-field" value="" name="name" id="name" type="text"
                                               placeholder="Tên">
                                        @error('name')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="">Email</label>
                                        <input class="signup-field" value="" name="email" id="name" type="text"
                                               placeholder="Email">
                                        @error('email')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="">Địa chỉ</label>
                                        <input class="signup-field" value="" name="dia_chi" id="name" type="text"
                                               placeholder="Địa chỉ">
                                        @error('dia_chi')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="">Số điện thoại</label>
                                        <input class="signup-field" name="sdt" value="" id="name" type="text"
                                               placeholder="Số điện thoại">
                                        @error('sdt')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="">Tên lớp</label>
                                        <input class="signup-field" name="ten_lop" id="ten_lop" type="text" value="" disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="">Giá</label>
                                        <input class="signup-field" name="gia_khoahoc" id="ten_lop" type="text" value="" disabled>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label for="">Tên khóa học</label>
                                        <input class="signup-field" name="ten_khoahoc" id="ten_khoahoc" type="text" value="" disabled>
                                        {{-- @error('ten_khoahoc')
                                      <div class="text-danger">{{$message}}</div>
                                  @enderror --}}
                                    </div>
                                    {{-- <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="cpassword" id="cpassword" type="text"
                                            placeholder="Confirm Password">
                                    </div> --}}

                                    {{-- <div class="col-lg-12 col-sm-12">
                                        <input class="signup-field" name="dia_chi" id="dia_chi" type="text"
                                            placeholder="Địa chỉ">
                                            @error('dia_chi')
                                          <div class="text-danger">{{$message}}</div>
                                      @enderror
                                    </div> --}}
                                    {{-- <div class="col-lg-12 col-sm-12">
                                        <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">Hình ảnh <span class="text-danger">(*)</span></label>

                                        <div class="col-md-9 col-sm-8">
                                          <input class="signup-field" type="file" name="hinh_anh" value="" id="">
                                          @error('hinh_anh')
                                          <div class="text-danger">{{$message}}</div>
                                      @enderror
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="zip" id="zip" type="text"
                                            placeholder="Postcode/Zip">
                                    </div> --}}
                                    <div class="col-sm-12">
                                        <div class="term-and-condition">
                                            <input type="checkbox" id="term">
                                            <label for="term">I agree to <a href="#">term &amp; condition</a> and <a
                                                    href="#">privacy policy</a></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 submit-area">
                                        <button class="submit more-link" type="submit">Đăng ký học</button>
                                        <div id="msg" class="message"></div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- End:Signup Form  -->
                    </div>
                    <!-- .col-md-6 .col-sm-12 /- -->
                </div>
            </div>
            <!-- row /- -->
        </div>
        <!-- container /- -->
    </section>
@endsection
