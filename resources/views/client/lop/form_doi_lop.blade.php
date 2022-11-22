@extends('client.profile.layout')
@section('title')
    Đăng kí đổi lớp
@endsection
@section('content')

    <div class="container">
        <h2>Đăng ký đổi lớp</h2>

        <form action="{{route('doi_lop')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Lớp học cũ</label>
                    <input type="text" class="form-control" value="{{$lop_cu->ten_lop}}" disabled>
                    <input type="text" name="id_lop_cu" value="{{$lop_cu->id}}" hidden>
                    {{-- <input type="text" name="id_xeplop" value="{{$xep_lop->id}}" hidden> --}}
                </div>

                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Lớp học mới</label>
                    <select class="form-control" name="id_lop_moi">
                        <option value="">----- Chọn lớp mới muốn đổi ------</option>
                        @foreach ($lop_moi as $value )
                        <option value="{{$value->id}}">{{$value->ten_lop}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Lý do</label>
                    <textarea class="form-control" style="height: 150px;" name="ly_do" placeholder="Lý do bạn muốn đổi lớp"></textarea>
                </div>

                <div class="pt-2">
                    <input type="text" name="status" id="" value="0" hidden>
                    <input type="text" name="id_user" id="" value="{{Auth::user()->id}}" hidden>
                    <button type="submit" onclick="return confirm('Bạn có chắc muốn đổi lóp ')" class="btn btn-primary">Gửi yêu cầu </button>
                </div>
            </div>

        </form>
    </div>
@endsection
