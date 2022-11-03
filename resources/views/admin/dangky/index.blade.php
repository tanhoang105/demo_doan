@extends('Admin.templates.layout')
@section('content')
    {{-- <div class="row p-3">
        <button class="btn btn-primary"><a style="color: red"
                href="{{ route('route_BE_Admin_Add_Ca_Hoc') }} ">Thêm</a></button>
    </div> --}}
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
                <th scope="col">Ngày đăng ký</th>
                <th scope="col">Người đăng ký</th>
                <th scope="col">Lớp học đăng ký</th>
                <th scope="col">Khóa học đăng ký</th>
                <th scope="col">Học phí</th>
                <th scope="col">Thanh toán</th>
               
                <th scope="col">Sửa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row"> {{ $loop->iteration }}</th>
                    <td> {{ $item->ngay_dang_ky }}</td>
                    <td> {{ $item->ten_hoc_vien }}</td>
                    <td> {{ $item->ten_lop }}</td>
                    <td> {{ $item->ten_khoa_hoc }}</td>
                    <td> {{ $item->gia_khoa_hoc }}</td>
                    <td> <button class="btn btn-primary">Xuất hóa đơn</button></td>
                  

                    <td> <button class="btn btn-warning"><a
                                href="{{ route('route_BE_Admin_Edit_Ca_Hoc', ['id' => $item->id]) }}"> Sửa
                            </a></button></td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Ca_Hoc', ['id' => $item->id]) }}">
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
