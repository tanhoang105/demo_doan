@extends('client.profile.layout')
@section('title')
    - Lớp
@endsection
@section('content')
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
{{--    <section class="account-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                @foreach ($list as $value)--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-12 border rounded">--}}
{{--                        <div class="feat_course_item">--}}
{{--                            <div class="feat_cour_price">--}}
{{--                                <h3> {{ $value->ten_lop }}</h3>--}}
{{--                                <span class="feat_cour_tag"> {{ $value->so_luong }}/40 </span>--}}
{{--                            </div>--}}
{{--                            <div class="pb-4">--}}
{{--                                <div class="">--}}
{{--                                    <span class="p-1"> <i class="fa-solid fa-user bg-white"></i>--}}
{{--                                        {{ $value->ten_giang_vien }} </span>--}}
{{--                                </div>--}}
{{--                                <div class="">--}}
{{--                                    <span class="p-1"> <i class="fa-solid fa-calendar-days"></i>--}}
{{--                                        {{ $value->ngay_bat_dau }} </span>--}}
{{--                                </div>--}}
{{--                                <div class="">--}}
{{--                                    <span class="p-1"> <i class="fa-solid fa-alarm-clock"></i> {{ $value->ca_hoc }}--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                                <div class="">--}}
{{--                                    <span>Trang thái: </span>--}}
{{--                                    @if ($value->ngay_bat_dau >= date('Y-m-d'))--}}
{{--                                        <span class="p-1"> <i class="fa-solid fa-alarm-clock"></i> Chưa học--}}
{{--                                        </span>--}}
{{--                                    @else--}}
{{--                                        <a>đã học</a>--}}
{{--                                    @endif--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="feat_cour_rating">--}}
{{--                                --}}{{-- <a class="btn btn-primary" href="{{route('form_doi_lop',$value->lop_id)}}">Đổi lớp</a> --}}
{{--                                <form action="{{ route('form_doi_lop', $value->lop_id) }}" method="GET">--}}
{{--                                    @csrf--}}
{{--                                    --}}{{-- <input type="date" name="ngaybatdau_lopcu" value="{{$value->ngay_bat_dau}}" id=""> --}}
{{--                                    <input type="text" value="{{ $value->khoa_hoc_id }}" name="khoahoc_id" hidden--}}
{{--                                        id="">--}}
{{--                                    <input type="text" name="xeplop_id" value="{{ $value->id }}" hidden--}}
{{--                                        id="">--}}
{{--                                    @if ($value->ngay_bat_dau >= date('Y-m-d'))--}}
{{--                                        <button class="btn btn-primary">Đổi lớp</button>--}}
{{--                                    @endif--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- container /- -->--}}
{{--    </section>--}}

    <h2>Danh sách các lớp đã đăng ký</h2>
    <div class="List">
        <div class="row justify-content-center">
            @foreach ($list as $value)
            <div class="col-lg-3 box-shadow br-15" style="margin-left: 70px;height: 250px;margin-top: 40px;">
                <div class="row p-1">
                    <h4 class="col-lg-8 pt-1">{{ $value->ten_lop }}</h4>

                    <div class="col-lg-4 p-2">
                        @if ($value->ngay_bat_dau >= date('Y-m-d'))
                        <div class="br-15" style="background: #30e534">
                            <span class="d-flex justify-content-center text-white">Đã học</span>
                        </div>
                        @else
                        <div class="br-15" style="background: #ff0018">
                            <span class="d-flex justify-content-center text-white">Chưa học</span>
                        </div>
                        @endif

                    </div>
                </div>

                <div class="w-100" style="height: 15px"></div>

                <div class="">
                    <label class="">Số lượng: </label>
                    <span class="">{{ $value->so_luong }}/40</span>
                </div>

                <div class="">
                    <label class="">Giảng viên: </label>
                    <span class="">{{ $value->ten_giang_vien }}</span>
                </div>

                <div class="">
                    <label class="">Ngày bắt đầu: </label>
                    <span class="">{{ $value->ngay_bat_dau }}</span>
                </div>

                <div class="">
                    <label class="">Ca hojc: </label>
                    <span class="">{{ $value->ca_hoc }}</span>
                </div>

                <hr>

                <div class="Change">
                    {{-- <a class="btn btn-primary" href="{{route('form_doi_lop',$value->lop_id)}}">Đổi lớp</a> --}}
                    <form action="{{ route('form_doi_lop', $value->lop_id) }}" method="GET">
                        @csrf
                        {{-- <input type="date" name="ngaybatdau_lopcu" value="{{$value->ngay_bat_dau}}" id=""> --}}
                        <input type="text" value="{{ $value->khoa_hoc_id }}" name="khoahoc_id" hidden
                               id="">
                        <input type="text" name="xeplop_id" value="{{ $value->id }}" hidden
                               id="">
                        @if ($value->ngay_bat_dau >= date('Y-m-d'))
                    <button class="btn btn-primary">
                        Đổi lớp
                    </button>
                        @endif
                    </form>
                </div>

            </div>
            @endforeach

        </div>
    </div>

@endsection
