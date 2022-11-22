@extends('client.profile.layout')
@section('title')
    Các khóa học
@endsection
@section('content')
<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
</div>

    <h2>Các Khóa học</h2>
    <div class="">
    <div class="row">
        @foreach ($list as $value)
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
                        <span> {{ number_format($value->gia_khoa_hoc) }} VNĐ</span>
                    </div>

                    <hr>

                    <div class="">
                        <form action="{{route('form_doi_khoa',$value->id)}}" method="GET">
                            @csrf
                            <input type="text" value="{{$lopcu_id}}" name="lopcu_id" hidden id="">
                            <input type="text" name="dangky_id" value="{{$dangky_id}}" hidden id="">
                            <button class="btn btn-primary">Chọn khóa học </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
