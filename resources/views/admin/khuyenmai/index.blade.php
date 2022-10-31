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
                <th scope="col">Mã khuyến mại </th>
                <th scope="col">Loại khuyến mại </th>
                <th scope="col">Giảm giá </th>
                <th scope="col">Ngày bắt đầu </th>
                <th scope="col">Ngày kết thúc</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row"> {{ $loop->iteration }}}</th>
                    <td> {{ $item->ma_khuyen_mai }}</td>
                    <td> {{ $item->loai_khuyen_mai }}</td>
                    <td> {{ $item->giam_gia . '%' }}</td>
                    <td> {{ $item->ngay_bat_dau }}</td>
                    <td> {{ $item->ngay_ket_thuc }}</td>
                    <td> {!! $item->mo_ta !!}</td>
                    <td> <button class="btn btn-warning"><a
                                href="{{ route('route_BE_Admin_Edit_Khuyen_Mai', ['id' => $item->id]) }}"> Sửa
                            </a></button></td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Khuyen_Mai', ['id' => $item->id]) }}">
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
