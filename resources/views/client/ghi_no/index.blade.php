@extends('Client.templates.layout')
@section('title')
    - Trainers
@endsection
@section('content')
    <h2 style="text-align: center;">Tài khoản ghi nợ</h2>
    <div style=" text-align: center">
        @foreach ($ghi_no as $value)
            <p><b>học viên: </b> {{ $value->name }}</p>
            <p><b>Số dư: </b>
                {{ number_format($value->tien_no) }} VND
            <p><b>Trạng thái: </b>
                Đang hoạt động
            </p>
    </div>
    @endforeach
@endsection
