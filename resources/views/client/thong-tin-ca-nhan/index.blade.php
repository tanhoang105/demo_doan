@extends('client.templates.layout')
@section('title')
    - Thông tin cá nhân
@endsection
@section('content')

    <!-- Start: Account Section
    ==================================================-->
    <section class="account-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="reg_wrap">
                        <!-- Start: Image -->
                        <div class="reg_img">
                            <img src="{{ asset('client/images/hero-men.png') }}" alt="">
                        </div>

                        <!-- Start:  Signup  Form  -->
                        <div class="registration-form">
                            <h2> Thông Tin Cá Nhân </h2>
                            <form method="post" enctype="multipart/form-data" action="">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="name" value="{{Auth::user()->name}}" id="fname" type="text"
                                               placeholder="Họ & Tên">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="email" value="{{Auth::user()->email}}" id="remail" type="text"
                                               placeholder="Email">
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" value="{{Auth::user()->password}}" name="password" id="password" type="text"
                                               placeholder="">
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="sdt"value="0{{Auth::user()->sdt}}" id="cpassword" type="text"
                                               placeholder="Điện thoại">
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <input value="{{Auth::user()->dia_chi}}" class="signup-field" name="dia_chi" id="address" type="text"
                                               placeholder="Địa chỉ">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" value="5" name="trang_thai" id="city" type="hidden">
                                    </div>
                                    <div hidden class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="hinh_anh" id="zip" type="file">
                                    </div>

                                    <button class="btn btn-success">Thay đổi</button>
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
