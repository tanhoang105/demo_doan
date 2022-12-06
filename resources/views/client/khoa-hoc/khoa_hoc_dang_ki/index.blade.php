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
                <div class="col-lg-4 box-shadow br-15" style="height: 370px; width: 350px;;margin-left: 20px;margin-top: 40px;">
                    <div class="row">
                        <div class="image pt-2">
                            <img class="br-15" src="{{ Storage::url($value->hinh_anh) }}" alt="image" style="width: 345px;height: 185px;">
                        </div>

                        <div class="pt-2">
                            <h3>{{ $value->ten_khoa_hoc }}</h3>
                        </div>

                        <div class="">
                            <label class="text-dark">Danh mục:</label>
                            <span class="text-dark">{{ $value->ten_danh_muc }}</span>
                        </div>

                        <div class="">
                            <label class="text-dark">Giá tiền: </label>
                            <span class="text-dark"> {{ number_format($value->gia_khoa_hoc,0,'.','.') }}VNĐ</span>
                        </div>

                        <hr>

                        <div class="">
                            {{-- <a class="btn btn-primary" href="{{route('form_doi_lop',$value->lop_id)}}">Đổi lớp</a> --}}
                            <form action="{{route('get_khoa_hoc')}}" method="GET">
                                @csrf
                                <input type="text" name="khoahoc_id" hidden id="" value="{{$value->id}}">
                                <input hidden type="text" value="{{$value->lop_id}}" name="lopcu_id"  id="">
                                <input hidden type="text" name="dangky_id" value="{{$value->dang_ky_id}}"  id="">
                                <button class="btn btn-primary" style="border-radius: 8px">Đổi khóa học</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
@endsection
