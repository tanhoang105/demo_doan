@extends('Admin.templates.layout')
@section('content')

    <div class="row p-3">
        <a href=" {{ route('route_BE_Admin_Add_Banner') }} "><button class="btn btn-primary">Thêm</button></a>
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
            <th scope="col">Ảnh Banner </th>
            <th scope="col">Sửa</th>
            <th scope="col">Xóa </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $key => $item)
            <tr>
                <th scope="row"> {{ $loop->iteration }}</th>
                <td> <img src="{{ Storage::url($item->anh_banner) }}" style="width: 100px;"> </td>
                <td>
                   <a href=" {{ route('route_BE_Admin_Edit_Banner',['id' => $item->id] ) }} ">
                    <button class="btn btn-success"> Sửa </button></a>
                </td>
                <td>
                    <a href=" {{ route('route_BE_Admin_Xoa_Banner',['id' => $item->id] ) }} ">
                        <button class="btn btn-danger"
                        onclick="return confirm('Bạn có chắc muốn xóa ?')"> Xóa </button></a>
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
