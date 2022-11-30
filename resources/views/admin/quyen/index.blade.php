@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <button class="btn btn-primary"><a style="color: #fff" href=" {{ route('route_BE_Admin_Add_Quyen') }}">
                <i class="fas fa-plus "></i>
                Thêm</a>

        </button>
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
                <th> <input id="check_all" type="checkbox" /></th>
                <th scope="col">STT</th>
                <th scope="col">Tên Quyền</th>
                <th scope="col">Nhóm Quyền</th>

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
                    <td> {{ $item->ten }}</td>
                    <td> {{ $item->trang_thai }}</td>
                    <td>
                        <button class="btn btn-success">
                            <a style="color:#fff" href="{{ route('route_BE_Admin_Edit_Quyen', ['id' => $item->id]) }}">
                                <i class="fas fa-edit "></i> Sửa</a></button>
                    </td>
                    <td>
                        <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger">
                            <a style="color:#fff" href="{{ route('route_BE_Admin_Xoa_Quyen', ['id' => $item->id]) }}">
                                <i class="fas fa-trash-alt"></i> Xóa</a>
                        </button>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('params')->links() }}
        </div>
    </div>
@endsection
