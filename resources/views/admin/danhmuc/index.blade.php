@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_Admin_BE_Danh_Muc_Khoa_Hoc') }}
@endsection
@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_Admin_BE_Add_Danh_Muc') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>

        </a>
        <a style="margin-left: 10px" href="{{ route('route_Admin_BE_Danh_Muc_Khoa_Hoc') }}">
            <button class='btn btn-warning'> Tất cả danh sách</button>
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
    <form method="post" action="{{ route('route_Admin_BE_Xoa_All_Danh_Muc') }}" enctype="multipart/form-data">

        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Tên danh mục </th>
                    <th scope="col">Sửa</th>
                    <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $item)
                    <tr>
                        <td><input {{ in_array($item->id, $arrayIdDanhMuc) ? 'hidden' : 'value=' . $item->id }} class="checkitem" type="checkbox" name="id[]"  /></td>
                        <th scope="row"> {{ $loop->iteration }}</th>
                        <td> {{ $item->ten_danh_muc }}</td>
                        <td>
                            <a class="btn btn-success" style="color: aliceblue"
                                href="{{ route('route_Admin_BE_Edit_Danh_Muc', ['id' => $item->id]) }}">
                                <i class="fas fa-edit "></i> Sửa</a>
                        </td>
                        <td>
                            <a {{ in_array($item->id, $arrayIdDanhMuc) ? 'hidden' : '' }}
                                onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"
                                style="color: aliceblue"
                                href="{{ route('route_Admin_BE_Xoa_Danh_Muc', ['id' => $item->id]) }}">
                                <i class="fas fa-trash-alt"></i> Xóa</a>
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
