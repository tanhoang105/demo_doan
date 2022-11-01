@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <button class="btn btn-primary"><a style="color: red" href=" {{route('route_BE_Admin_Add_Khoa_Hoc')}}">Thêm</a></button>
    </div>
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
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
                <th scope="col">Tên Khóa Học </th>
                <th scope="col">Tên Danh Mục </th>
                <th scope="col">Ảnh </th>
                <th scope="col">Mô Tả </th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row"> {{ $loop->iteration}}</th>
                    <td> {{ $item->ten_khoa_hoc }}</td>
                    <td> {{ $item->ten_danh_muc }}</td>
                    <td> <img width="150px" src="{{ Storage::url($item->hinh_anh)  }}" alt=""></td>
                    <td> {!!$item->mo_ta!!}</td>
                    <td> <button class="btn btn-warning"><a
                                href="{{ route('route_BE_Admin_Chi_Tiet_Khoa_Hoc', ['id' => $item->id]) }}"> Sửa
                            </a></button></td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Khoa_Hoc', ['id' => $item->id]) }}">
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
