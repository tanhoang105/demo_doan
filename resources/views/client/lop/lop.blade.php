@extends('client.profile.layout')
@section('title')
    - Lớp
@endsection
@section('content')

    <!-- Start: Account Section
    ==================================================-->
    <section class="account-section">
        <div class="container">
            {{-- <div class="row">
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
                                        <input class="signup-field" name="name" id="fname" type="text"
                                               placeholder="Họ & Tên">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="email" id="remail" type="text"
                                               placeholder="Email">
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="password" id="password" type="text"
                                               placeholder="">
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="sdt" id="cpassword" type="text"
                                               placeholder="Điện thoại">
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <input class="signup-field" name="dia_chi" id="address" type="text"
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
            </div> --}}
            <!-- row /- -->

            <div class="row">
                @foreach($list as $value)
                <div class="col-lg-3 col-md-6 col-sm-12 border rounded">
                    <div class="feat_course_item">
                        <div class="feat_cour_price">
                            <h3> {{ $value->ten_lop }}</h3>
                            <span class="feat_cour_tag"> 39/40 </span>
                        </div>
                        <div class="pb-4">
                            <div class="">
                                <span class="p-1"> <i class="fa-solid fa-user bg-white"></i> {{ $value->ten_giang_vien }} </span>
                            </div>
                            <div class="">
                                <span class="p-1"> <i class="fa-solid fa-calendar-days"></i> {{ $value->ngay_bat_dau }} </span>
                            </div>
                            <div class="">
                                <span class="p-1"> <i class="fa-solid fa-alarm-clock"></i> {{ $value->ca_hoc }} </span>
                            </div>
                        </div>

                        <div class="feat_cour_rating">
                            <button class="border rounded text-white bg-primary" style="width: 100px; height: 30px">Đổi lớp</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <!-- container /- -->
    </section>
    <!-- End : Account Section
    ==================================================-->
@endsection
