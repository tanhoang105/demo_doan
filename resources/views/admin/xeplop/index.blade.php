@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <button class="btn btn-primary"><a style="color: red"
                href="{{ route('route_BE_Admin_Add_Xep_Lop') }} ">Thêm</a></button>
    </div>
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên lớp</th>
                <th scope="col">Giảng viên</th>
                <th scope="col">Ngày Khai giảng</th>
                {{-- <th scope="col">Ca học </th> --}}
                <th scope="col">Phòng </th>
                <th scope="col">Chi tiết</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td> {{ $item->ten_lop }}</td>
                    <td> {{ $item->ten_giang_vien }}</td>
                    <td> {{ $item->ngay_dang_ky }}</td>
                    {{-- <td> {{ $item->ca_hoc }}</td> --}}
                    <td> {{ $item->ten_phong }}</td>
                    <td> <button class="btn btn-success"><a href=" {{route('route_BE_Admin_Detail_Xep_Lop', ['id_xep_lop'=> $item->id_lop] )}} ">Chi
                                tiết</a></button></td>
                    <td> <button class="btn btn-warning"><a
                                href="{{ route('route_BE_Admin_Edit_Xep_Lop', ['id' => $item->id_xep_lop]) }}"> Sửa
                            </a></button></td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Xep_Lop', ['id' => $item->id_xep_lop]) }}">
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
