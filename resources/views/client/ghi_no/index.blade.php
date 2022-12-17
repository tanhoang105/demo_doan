@extends('client.profile.layout')
@section('title')
    Số dư
@endsection
@section('content')
    <h2 class="font-family-awesome font-size-40">Tài khoản ghi nợ</h2>
    <div class="row d-flex align-content-center" style="height: 50px;font-size: 18px">
        @foreach ($ghi_no as $value)
        <div class="col">
            <p class="text-dark"><b>Chủ tài khoản: </b>{{ $value->name }}</p>
        </div>
            
        <div class="col">
            @if( ($value->tien_no) <= 0 )
            <p style="color: #ff0000;"><b class="text-dark">Số dư: </b>
            {{ number_format($value->tien_no) }} VND
            @else
            <p style="color: #13eb87;"><b class="text-dark">Số dư: </b>
                {{ number_format($value->tien_no) }} VND
            @endif
        </div>

        <div class="col">
            <p style="color: #13eb87;"><b class="text-dark">Trạng thái: </b>
            Đang hoạt động</p>
        </div>  
    </div>
    @endforeach
@endsection
