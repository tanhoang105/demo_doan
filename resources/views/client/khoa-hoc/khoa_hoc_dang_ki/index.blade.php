@extends('client.profile.layout')
@section('title')
    Khóa học đăng kí
@endsection
@section('content')
<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
</div>
<h2>Các Khóa học đã đăng kí </h2> <br>
    <section class="account-section">
        <div class="container">
            <div class="row">
                @foreach ($khoa_hoc_cu as $value)
                    <div class="col-lg-3 col-md-6 col-sm-12 border rounded">
                        <div class="feat_course_item">
                            <div>
                                <img src="{{asset('dist/img/courses1.jpg')}}" width="100%" alt="">
                            </div>
                            <div class="feat_cour_price">
                                <h3> {{ $value->ten_khoa_hoc }}</h3>
                                <span>Giá tiền: </span>
                                <span class="feat_cour_tag"> {{ number_format($value->gia_khoa_hoc) }} VND</span>
                            </div>
                            <div class="pb-4">
                                <div class="">
                                    <span>Danh mục:</span>
                                    <span class="p-1"> <i class="fa-solid fa-user bg-white"></i>
                                        {{ $value->ten_danh_muc }} </span>
                                </div>
                                {{-- <div class="">
                                    <span class="p-1"> <i class="fa-solid fa-calendar-days"></i>
                                        {{ $value->ngay_bat_dau }} </span>
                                </div>
                                <div class="">
                                    <span class="p-1"> <i class="fa-solid fa-alarm-clock"></i> {{ $value->ca_hoc }}
                                    </span>
                                </div> --}}
                            </div>
                                    <div class="feat_cour_rating">
                                      {{-- <a class="btn btn-primary" href="{{route('form_doi_lop',$value->lop_id)}}">Đổi lớp</a> --}}
                                      <form action="{{route('get_khoa_hoc')}}" method="GET">
                                        @csrf
                                        <input type="text" name="khoahoc_id" hidden id="" value="{{$value->id}}">
                                        <input hidden type="text" value="{{$value->lop_id}}" name="lopcu_id"  id="">
                                        <input hidden type="text" name="dangky_id" value="{{$value->dang_ky_id}}"  id="">
                                        <button class="btn btn-primary">Đổi khóa học</button>
                                      </form>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- container /- -->
    </section>
@endsection