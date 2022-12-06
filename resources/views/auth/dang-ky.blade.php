@extends('client.templates.layout')
@section('title')
    - Đăng Ký
@endsection
@section('content')
    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Đăng ký</h3>
                    <h4><a href="index-2.html"> Trang chủ </a> <span> &vert; </span> Đăng ký </h4>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->
    <!--/
    ==================================================-->



    <!-- Start: Account Section
    ==================================================-->
    <section class="account-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="reg_wrap">
                        <!-- Start: Image -->
                        <div class="reg_img">
                            <img src="{{ asset('client/images/hero-men.png')  }}" alt="">
                        </div>

                        <!-- Start:  Signup  Form  -->
                        <div class="registration-form">
                            <h2> Đăng ký tài khoản mới! </h2>
                            <form method="post" enctype="multipart/form-data" action="{{route('auth.store')}}">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="name" id="fname" type="text"
                                               placeholder="Họ tên">
                                               {{-- @error('name')
                                               <span style="color: red"> {{ $message }} </span>
                                           @enderror --}}
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="email" id="remail" type="email"
                                               placeholder="Email">
                                               {{-- @error('email')
                                               <span style="color: red"> {{ $message }} </span>
                                           @enderror --}}
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="password" id="password" type="password"
                                               placeholder="Mật khẩu">
                                               {{-- @error('password')
                                               <span style="color: red"> {{ $message }} </span>
                                           @enderror --}}
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="sdt" id="cpassword" type="text"
                                               placeholder="Điện thoại">
                                               {{-- @error('sdt')
                                               <span style="color: red"> {{ $message }} </span>
                                           @enderror --}}
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <input class="signup-field" name="dia_chi" id="address" type="text"
                                               placeholder="Địa chỉ">
                                               {{-- @error('dia_chi')
                                               <span style="color: red"> {{ $message }} </span>
                                           @enderror --}}
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" value="5" name="trang_thai" id="city" type="hidden">
                                    </div>
                                    <div hidden class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="hinh_anh" id="zip" type="file">
                                    </div>
                                    @if ($errors->any())
                                    <div class="alert alert-secondary"> 
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li style="color: red">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                    </div>
                                    @endif
                                    <div class="submit-area">
                                        <button class="submit more-link"> Đăng Ký Tài Khoản </button>
                                        <a href="{{route('auth.loginForm')}}" class="submit more-link"> Đăng Nhâp </a>
                                        <div id="lmsg" class="message"></div>
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
    <!-- End : Account Section
    ==================================================-->
@endsection
