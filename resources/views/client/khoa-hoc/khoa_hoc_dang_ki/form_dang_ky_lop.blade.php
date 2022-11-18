@extends('client.profile.layout')
@section('title')
    Đăng kí đổi khóa học
@endsection
@section('content')
    <h2>Đăng kí đổi khóa học</h2>
    <div>
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>
    <form action="{{ route('doi_khoa_hoc') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Khóa học cũ</label>
           @foreach ($khoa_hoc_cu as $item )
           <input type="text" value="{{ $item->ten_khoa_hoc }}" disabled class="form-control" id="exampleInputEmail1"
           aria-describedby="emailHelp" placeholder="">
            @endforeach
            <input type="text" name="id_lop_cu" value="{{ $lop_cu}}" hidden id="">
            {{-- <input type="text" name="id_xeplop" hidden value="{{$xep_lop->id}}" id=""> --}}
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Khóa học mới</label>
           <input type="text" value="{{ $khoa_hoc_moi->ten_khoa_hoc }}" disabled class="form-control" id="exampleInputEmail1"
           aria-describedby="emailHelp" placeholder="">
            {{-- <input type="text" name="" value="{{ $khoa_hoc_moi->id }}" hidden id=""> --}}
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Chọn lớp học mới</label>
            <select class="form-control form-control-sm" name="id_lop_moi" id="">
                <option value="">----- Chọn lớp mới muốn đổi ------</option>
                @foreach ($lop_moi as $value)
                    <option value="{{ $value->id }}">{{ $value->ten_lop }}</option>
                @endforeach
            </select>
        </div>
        <label for="exampleInputPassword1">Lý do đổi lớp</label>
        <div class="form-group">
            <textarea name="ly_do" placeholder="Lý do muốn đổi lớp" cols="190" rows="5">
    </textarea>
        </div>
        <input type="text" name="status" id="" value="2" hidden>
        <input type="text" name="id_user" id="" value="{{ Auth::user()->id }}" hidden>
        <button type="submit" onclick="return confirm('Bạn có chắc muốn đổi lóp ')" class="btn btn-success">Gửi yêu cầu
        </button>
    </form>
@endsection
