@extends('client.templates.layout')
@section('title') - Đổi mật khẩu
@endsection
@section('content')

    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Đổi mật khẩu</h3>
                    <h4><a href="{{ route('home') }} "> Trang chủ </a> <span> &vert; </span> Đổi mật khẩu </h4>
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
                            <img src="{{ asset('client/images/hero-men.png') }}" alt="">
                        </div>
                        <!-- Start:  Login Form  -->
                        <div class="login-form">
                            <h2> Đổi mật khẩu </h2>
                            <form action=" {{ route('doi_mat_khau') }} " method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <input class="login-field" name="email" id="lemail" type="email"
                                       placeholder="Email" autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif

                                <input class="login-field" name="password" id="password" type="password"
                                       placeholder="Password" autofocus>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                       
                                <input class="login-field" name="password_confirmation" id="lemail" type="password"
                                        placeholder="Password Confirm" autofocus>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif

                                <div class="submit-area">
                                    <button class="submit more-link"> Đổi Mật Khẩu </button>
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