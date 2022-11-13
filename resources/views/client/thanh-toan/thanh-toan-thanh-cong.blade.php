
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
                <h2 class="mb-2 ft-bold">Đơn hàng của bạn đã được thanh toán</h2>
                <!-- Text -->
                <p class="ft-regular fs-md mb-5">Đơn hàng <span class="text-body text-dark"></span> đã thanh toán. Chi tiết đơn hàng của bạn được hiển thị cho tài khoản cá nhân của bạn.</p>
                <!-- Button -->
                <a class="btn btn-dark" href="{{route('client_lich_su_dang_ky',[Auth::user()->id])}}">Xem chi tiết</a>
            </div>
        </div>
    </div>
</section>
@endsection
