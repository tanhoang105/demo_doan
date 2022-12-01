@extends('client.templates.layout')
@section('title') - Quên mật khẩu
@endsection
@section('content')

    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Quên mật khẩu</h3>
                    <h4><a href="{{ route('home') }} "> Trang chủ </a> <span> &vert; </span> Quên mật khẩu </h4>
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
                            <h2> Quên mật khẩu </h2>

                            <div>                           
                            @if (Session::has('message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong>{{ Session::get('message') }}</strong>
                                </div>
                            @endif
                            </div>

                            <form method="post" action=" {{ route('quen_mat_khau') }} ">
                                @csrf
                                <input class="login-field" name="email" id="lemail" type="email"
                                       placeholder="Email" autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <div class="submit-area">
                                    <button class="submit more-link"> Lấy lại mật khẩu </button>
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