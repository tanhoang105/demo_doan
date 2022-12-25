@extends('Client.templates.layout')
@section('content')
    {{-- {{dd($complete)}} --}}
    <section class="middle">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">
                    <!-- Icon -->
                    <div class="p-4 d-inline-flex align-items-center justify-content-center circle bg-light-success text-success mx-auto mb-4"><i class="lni lni-heart-filled fs-lg"></i></div>
                    <!-- Heading -->
                    <h2 class="mb-2 ft-bold">Khóa học của bạn đã được đăng ký !</h2>
                    <h4 class="mb-2 ft-bold">Cảm ơn <span class="text-body text-dark">{{$complete->name}}</span> đã cho trung tâm cơ hội được phục vụ !</h4>
                    <br>
                    {{--                      {{dd($data)}}--}}
                    <div style="border: 1px solid #CBC8C8;background:#CBC8C8;border-radius: 10px;color:orangered">
                        <p style="margin: 20px;text-align: left" class="mb-2 ft-bold">Mã đăng ký: <span class="text-body text-dark">{{$complete->id}}#</span></p>
                        <p style="margin: 20px;text-align: left" class="mb-2 ft-bold">Tên khóa học đăng ký: <span class="text-body text-dark">{{$complete->ten_khoa_hoc}}</span></p>
                        <p style="margin: 20px;text-align: left" class="mb-2 ft-bold">Tên lớp: <span class="text-body text-dark">{{$complete->ten_lop}}</span></p>   
                        <p style="margin: 20px;text-align: left" class="mb-2 ft-bold">Thời gian học: 
                            <span class="text-body text-dark">
                                @for ($i = 0; $i < count($layThu); $i++)
                                @foreach($layThu as $thu)
                                @if ($i == 0)
                                    @if ($layThu[$i]->id == $thu->id)
                                    {{$thu->ten_thu . ' &'}}
                                    @endif
                                @elseif($i == count($layThu)-1)
                                    @if ($layThu[$i]->id == $thu->id)
                                    {{$thu->ten_thu . ''}}
                                    @endif
                                @else
                                @if ($layThu[$i]->id == $thu->id)
                                {{$thu->ten_thu . ' &'}}
                                @endif
                                @endif
                                   
                                @endforeach
                                @endfor
                                -- {{$complete->ca_hoc . ' từ ' .$complete->thoi_gian_bat_dau .' đến ' .$complete->thoi_gian_ket_thuc}}</span></p>
                        <p style="margin: 20px;text-align: left" class="mb-2 ft-bold">Ngày bắt đầu - Ngày kết thúc: <span class="text-body text-dark">{{$complete->ngay_bat_dau}} - {{$complete->ngay_ket_thuc}}</span></p>
                        <p style="margin: 20px;text-align: left" class="mb-2 ft-bold">Người nhận hàng: <span class="text-body text-dark">{{$complete->name}} - {{$complete->sdt}}</span></p>
                        <p style="margin: 20px;text-align: left" class="mb-2 ft-bold">Email: <span class="text-body text-dark">{{$complete->email}}</span></p>

                        <p style="margin: 20px;text-align: left" class="mb-2 ft-bold">Tổng tiền: <span class="text-body text-dark">{{number_format($complete->gia_khoa_hoc)}} VNĐ</span></p>

                    </div><br>
                    <!-- Text -->
                    <p class="ft-regular fs-md mb-5">Mã đăng ký <span class="text-body text-dark">{{$complete->id}}#</span> đã hoàn thành. Chi tiết khóa học của bạn được hiển thị cho tài khoản cá nhân của bạn.</p>
                    <!-- Button -->
                    
                </div>
            </div>
        </div>
    </section>
@endsection
