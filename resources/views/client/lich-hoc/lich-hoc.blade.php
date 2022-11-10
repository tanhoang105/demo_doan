@extends('Client.profile.layout')
@section('title')
    - Lịch học
@endsection
@section('content')

<h2>Lịch học</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>STT</th>
            <th>Ngày</th>
            <th>Phòng</th>
            <th>Tên khóa học</th>
            <th>Lớp</th>
            <th>Giảng viên</th>
            <th>Ca</th>
            <th>Thời gian</th>
        </tr>
        </thead>
        <tbody>
      @foreach ($lichhoc as $value )
      <tr>
        <td>{{$value->id}}</td>
        <td>{{$value->ngay_dang_ky}}</td>
        <td>{{$value->ten_phong}}</td>
        <td>{{$value->ten_khoa_hoc}}</td>
        <td>{{$value->ten_lop}}</td>
        <td>{{$value->ten_giang_vien}}</td>
        <td>{{$value->ca_hoc}}</td>
        <td>{{$value->thoi_gian}}</td>
    </tr>
      @endforeach

        </tbody>
    </table>
</div>

@endsection