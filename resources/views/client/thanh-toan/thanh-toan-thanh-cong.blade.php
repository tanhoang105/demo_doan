
@extends('Client.templates.layout')
@section('title') - Thanh Toán thành công
@endsection
@section('content')
<section class="middle">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">
                <!-- Icon -->
                <div class="p-4 d-inline-flex align-items-center justify-content-center circle bg-light-success text-success mx-auto mb-4"><i class="lni lni-heart-filled fs-lg"></i></div>
                <!-- Heading -->
                <h2 class="mb-2 ft-bold">Khóa học của bạn đã được thanh toán</h2>
                <!-- Text -->
                <p class="ft-regular fs-md mb-5">Khóa học <span class="text-body text-dark"></span> đã thanh toán. Chi tiết khóa học của bạn được hiển thị cho tài khoản cá nhân của bạn.</p>
                <!-- Button -->
                @if (Auth::user())
                    <a class="btn btn-dark" href="{{ route('client_lich_su_dang_ky', [Auth::user()->id]) }}">Xem chi tiết</a>
                @else
                <a class="btn btn-dark" href="{{ route('auth.loginForm') }}">Đăng nhập để xem chi tiết</a>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection
