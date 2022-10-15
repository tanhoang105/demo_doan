@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <button class="btn btn-primary"><a style="color: red" href="">Thêm</a></button>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên lớp</th>
                <th scope="col">Giảng viên</th>
                <th scope="col">Ngày bắt đầu</th>
                <th scope="col">Ca học </th>
                <th scope="col">Phòng </th>
                <th scope="col">Chi tiết</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row"> {{ $item->id_xep_lop }}</th>
                    <td> {{ $item->ten_lop }}</td>
                    <td> {{ $item->ten_giang_vien }}</td>
                    <td> {{ $item->ngay_dang_ky }}</td>
                    <td> {{ $item->ca_hoc }}</td>
                    <td> {{ $item->ten_phong }}</td>
                    <td> <button class="btn btn-success"><a
                                href="{{ route('route_Admin_BE_Chi_Tiet_Xep_Lop', ['id' => $item->id_xep_lop]) }}">Chi
                                tiết</a></button></td>
                    <td> <button class="btn btn-warning"><a
                                href="{{ route('route_Admin_BE_Edit_Xep_Lop', ['id' => $item->id_xep_lop]) }}"> Sửa
                                </a></button></td>
                    <td> <button class="btn btn-danger"><a
                                href="{{ route('route_Admin_BE_Xoa_Xep_Lop', ['id' => $item->id_xep_lop]) }}">
                                Xóa</a></button></td>
                   

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('extParams')->links() }}
        </div>
    </div>
@endsection
