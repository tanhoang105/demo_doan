@extends('Client.templates.layout')
@section('title') - Trainers
@endsection
@section('content')
<h2>Tài khoản ghi nợ</h2>
@foreach ($ghi_no as $value )
    <p><b>học viên: </b> {{$value->name}}</p>
    <p><b>Tiền nợ: </b> 
        @if ($value->tien_no > 0)
        + {{$value->tien_no}}
        @elseif ($value->tien_no < 0)
        - {{$value->tien_no}}
        @elseif ($value->tien_no = 0)
        {{$value->tien_no}}
    @endif</p>
    <p><b>Trạng thái: </b> @if ($value->trang_thai == 0)
        Hết nợ
        @elseif ($value->trang_thai == 1)
        Âm tiền
        @elseif ($value->trang_thai == 2)
        Dương tiền
    @endif</p>

@endforeach
@endsection