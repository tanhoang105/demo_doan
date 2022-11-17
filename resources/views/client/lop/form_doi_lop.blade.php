@extends('client.profile.layout')
@section('title')
    Đăng kí đổi lớp
@endsection
@section('content')
<h2>Đăng kí đổi lớp</h2>
<form action="{{route('doi_lop')}}" method="POST">
@csrf
<div class="form-group">
    <label for="exampleInputEmail1">Lớp học cũ</label>
    <input type="text" value="{{$lop_cu->ten_lop}}" disabled class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
    <input type="text" name="id_lopcu" value="{{$lop_cu->id}}" hidden id="">
    <input type="text" name="id_xeplop" hidden value="{{$xep_lop->id}}" id="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Lớp học mới</label>
    <select class="form-control form-control-sm" name="id_lopmoi" id="">
        <option value="">----- Chọn lớp mới muốn đổi ------</option>
        @foreach ($lop_moi as $value )
        <option value="{{$value->id}}">{{$value->ten_lop}}</option>
        @endforeach
    </select>
  </div>
  <label for="exampleInputPassword1">Lý do</label>
  <div class="form-group">
    <textarea name="ly_do" placeholder="Lý do muốn đổi lớp"  cols="190" rows="5">
    </textarea>
  </div>
  <button type="submit" onclick="return confirm('Bạn có chắc muốn đổi lóp ')" class="btn btn-success">Submit</button>
</form>
@endsection