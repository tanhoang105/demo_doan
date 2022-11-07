@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">

        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Khoa_Hoc') }}">
            <button class='btn btn-success'> <i class="fas fa-plus "></i> Thêm</button>

        </a>
    </div>
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif


    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Khoa_Hoc') }}" enctype="multipart/form-data">
        @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> <input id="check_all" type="checkbox" /></th>
                <th scope="col">STT</th>
                <th scope="col">Tên Khóa Học </th>
                <th scope="col">Tên Danh Mục </th>
                <th scope="col">Giá khóa học </th>
                <th scope="col">Ảnh </th>
                <th scope="col">Mô Tả </th>
                <th scope="col">Sửa</th>
                <th scope="col">
                    <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>

                  </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <td><input class="checkitem" type="checkbox" name="id[]" value="{{ $item->id }}" /></td>
                    <th scope="row"> {{ $loop->iteration }}</th>
                    <td> {{ $item->ten_khoa_hoc }}</td>
                    <td> {{ $item->ten_danh_muc }}</td>
                    <td> {{ $item->gia_khoa_hoc . '  VNĐ' }}</td>
                    <td> <img width="150px" src="{{ Storage::url($item->hinh_anh) }}" alt=""></td>
                    <td> {!! $item->mo_ta !!}</td>
                    <td> <button class="btn btn-warning"><a
                                href="{{ route('route_BE_Admin_Chi_Tiet_Khoa_Hoc', ['id' => $item->id]) }}">
                                <i class="fas fa-edit "></i> Sửa
                            </a></button></td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Khoa_Hoc', ['id' => $item->id]) }}">
                                <i class="fas fa-trash-alt"></i>     Xóa</a></button></td>

                </tr>
            @endforeach

        </tbody>
    </table></form>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('params')->links() }}
        </div>
    </div>
@endsection
