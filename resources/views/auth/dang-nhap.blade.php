@extends('client.templates.layout')
@section('title') - About
@endsection
@section('content')




  <!-- header -->
  <header class="single-header">
    <!-- Start: Header Content -->
    <div class="container">
        <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-sm-12">
                <!-- Headline Goes Here -->
                <h3>Login Form</h3>
                <h4><a href="index-2.html"> Home </a> <span> &vert; </span> Login </h4>
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
                        <img src="images/hero-men.png" alt="">
                    </div>
                    <!-- Start:  Login Form  -->
                    <div class="login-form">
                        <h2> Login to Your Account </h2>
                        <div>
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        </div>
                        <div>
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                        </div>
                        <form method="post" action="{{route('auth.login')}}">
                            @csrf
                            <input class="login-field" name="email" id="lemail" type="text"
                                placeholder="Enter Your Email">
                            <input class="login-field" name="password" id="lpassword" type="text"
                                placeholder="Enter Your Password">
                            <div class="lost_pass">
                                <input type="checkbox" id="rem-checkbox-input">
                                <label for="rem-checkbox-input" class="rem-checkbox">
                                    <span class="rem-me">Remember me</span>
                                </label>
                                <a href="#" class="forget"> Lost your password? </a>
                            </div>
                            <div class="submit-area">
                                {{-- <a href="login.html" class="submit more-link"> Đăng Nhập </a> --}}
                                <button class="submit more-link"> Đăng Nhập </button>
                                <a href="{{route('auth.getdangki')}}" class="submit more-link"> Đăng Ký Tài Khoản</a>
                                <div id="lmsg" class="message"></div>
                            </div>
                        </form>
                    </div>
                    <!-- End:Login Form  -->
                </div>
            </div>
            <!-- .col-md-6 .col-sm-12 /- -->
        </div>
        <!-- row /- -->
    </div>
    <!-- container /- -->
</section>
<!-- End : Account Section 
==================================================-->



@endsection