@extends('Admin.templates.layout')
@section('form-search')
    {{route('route_BE_Admin_Khoa_Hoc')}}
@endsection
@section('content')
    <div class="row p-3">

        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Khoa_Hoc') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>

        </a>
        <a style="margin-left: 10px" href="{{ route('route_BE_Admin_Khoa_Hoc') }}">
            <button class='btn btn-warning'> Tất cả danh sách</button>
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

    <form action="" method="get">
        @csrf
        <div class="row p-3">
            <div class="col-2">
                <select class="form-control" name="danh_muc" id="">
                    <option value="">Lọc theo danh mục</option>
                    @foreach ($danh_muc as $itemDanhMuc)
                        <option value=" {{ $itemDanhMuc->id }} "> {{ $itemDanhMuc->ten_danh_muc }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-2">
                <select class="form-control" name="gia_khoa_hoc" id="">
                    <option value="">Lọc theo giá khóa học</option>
                        <option value="1"> Dưới 200.000 VNĐ </option>
                        <option value="2"> Khoảng từ 200.000 đến 500.000 VNĐ </option>
                        <option value="3"> Trên 500.000 VNĐ </option>
                </select>
            </div>

            <div class="col-2">
                <select class="form-control" name="luot_xem" id="">
                    <option value="">Lọc theo lượt xem</option>
                        <option value="1"> Từ nhiều nhất đến ít nhất </option>
                        <option value="2"> Từ ít đến nhiều nhất </option>
                </select>
            </div>

            <div class="col-1">
                <button class="btn btn-success">Lọc</button>
            </div>
        </div>
    </form>

    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Khoa_Hoc') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Khóa Học </th>
                    <th scope="col">Tiền tố  </th>
                    <th scope="col">Tên Danh Mục </th>
                    <th scope="col">Giá khóa học </th>
                    <th scope="col">Ảnh </th>
                    {{-- <th scope="col">Lượt xem </th> --}}
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
                        <td> {{ $item->tien_to }}</td>
                        <td> {{ $item->ten_danh_muc }}</td>
                        <td> {{ number_format($item->gia_khoa_hoc, 0, '.' ,'.') }} VNĐ</td>
                        <td> <img width="150px" src="{{ Storage::url($item->hinh_anh) }}" alt=""></td>
                        {{-- <td> {!! $item->luot_xem !!}</td> --}}
                        <td>
                           
                                <a  class="btn btn-success" style="color: aliceblue" href="{{ route('route_BE_Admin_Chi_Tiet_Khoa_Hoc', ['id' => $item->id]) }}">
                                    <i class="fas fa-edit "></i> Sửa</a>
                        </td>
                        <td>
                                <a  onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger" style="color: aliceblue" href="{{ route('route_BE_Admin_Xoa_Khoa_Hoc', ['id' => $item->id]) }}">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </form>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('params')->links() }}
        </div>
    </div>
@endsection
