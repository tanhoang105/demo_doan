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
    @if (session()->has('warning'))
    <div class="alert alert-warning">
        {{ session()->get('warning') }}
    </div>
@endif
</div>

        <div class="container">
            <h2>Các Khóa học đã đăng kí </h2>
            <div class="row">
                @foreach ($khoa_hoc_cu as $value)
                <div class="col-lg-3 box-shadow br-15" style="height: 320px;margin-left: 70px;margin-top: 40px;">
                    <div class="row">
                        <div class="image pt-2">
                            <img src="{{asset('dist/img/courses1.jpg')}}" alt="image" style="width: 275px;height: 145px;">
                        </div>

                        <div class="pt-2">
                            <h4>{{ $value->ten_khoa_hoc }}</h4>
                        </div>

                        <div class="">
                            <label>Danh mục:</label>
                            <span>{{ $value->ten_danh_muc }}</span>
                        </div>

                        <div class="">
                            <label>Giá tiền: </label>
                            <span> {{ number_format($value->gia_khoa_hoc,0,'.','.') }} VNĐ</span>
                        </div>

                        <hr>

                        <div class="">
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
@endsection
