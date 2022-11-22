@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Hoc_Vien') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>
        </a>

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
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Hoc_Vien') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Tên học viên </th>
                    <th scope="col">Địa chỉ </th>
                    <th scope="col">Email </th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>

                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $item)
                    <tr>
                        <td><input class="checkitem" type="checkbox" name="id[]" value="{{ $item->user_id }}" /></td>
                        <th scope="row"> {{ $loop->iteration }}</th>
                        <td> {{ $item->ten_hoc_vien }}</td>
                        <td> {{ $item->dia_chi }}</td>
                        <td> {{ $item->email }}</td>
                        <td>
                            {{ $item->sdt }}
                        </td>

                        <td>
                            <button class="btn btn-success">
                                <a style="color: #fff" href="{{ route('route_BE_Admin_Edit_Hoc_Vien', ['id' => $item->user_id]) }}">
                                    <i class="fas fa-edit "></i> Sửa</a>
                            </button>
                        </td>
                        <td>
                            <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger">
                                <a style="color: #fff" href="{{ route('route_BE_Admin_Xoa_Hoc_Vien', ['id' => $item->user_id]) }}">
                                    <i class="fas fa-trash-alt"></i> Xóa</a>

                            </button>
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
