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
            <div class="col-lg-3 box-shadow br-15" style="height: 370px; width: 350px;;margin-left: 20px;margin-top: 40px;">
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
                        <form action="{{route('form_doi_khoa',$value->id)}}" method="GET">
                            @csrf
                            <input type="text" value="{{$lopcu_id}}" name="lopcu_id" hidden id="">
                            <input type="text" name="dangky_id" value="{{$dangky_id}}" hidden id="">
                            <button class="btn btn-primary" style="border-radius: 8px">Chọn khóa học </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
