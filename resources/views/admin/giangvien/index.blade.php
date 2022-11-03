@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <button class="btn btn-primary"><a style="color: red"
                href=" {{ route('route_BE_Admin_Add_Khuyen_Mai') }}">Thêm</a></button>
    </div>
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif


    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên giảng viên </th>
                <th scope="col">Địa chỉ </th>
                <th scope="col">Email </th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row"> {{ $loop->iteration }}</th>
                    <td> {{ $item->ten_giang_vien }}</td>
                    <td> {{ $item->dia_chi_giang_vien }}</td>
                    <td> {{ $item->email_giang_vien}}</td>
                    <td> 
                        {{ $item->sdt_giang_vien}}
                    </td>
                    
                    <td> <button class="btn btn-warning"><a
                                href="{{ route('route_BE_Admin_Edit_Giang_Vien', ['id' => $item->id_giang_vien]) }}"> Sửa
                            </a></button></td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Giang_Vien', ['id' => $item->id_giang_vien]) }}">
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
