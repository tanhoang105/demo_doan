@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_create') }}">
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
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Khuyen_Mai') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Mã khuyến mại </th>
                    <th scope="col">Loại khuyến mại </th>
                    <th scope="col">Loại giảm giá </th>
                    <th scope="col">Giảm giá </th>
                    <th scope="col">Ngày bắt đầu </th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Mô tả</th>
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
                        <td> {{ $item->ma_khuyen_mai }}</td>
                        <td> {{ $item->loai_khuyen_mai == 1 ? 'Đối với khóa học' : "Đối với tất cả khóa học" }}</td>
                        <td> {{ $item->loai_giam_gia == 1 ? 'Đối với giá tiềm' : "Đối với phần trăm" }}</td>
                        <td> {{  $item->loai_giam_gia == 1 ? number_format($item->giam_gia  , 0, '.' ,'.').' VNĐ' : $item->giam_gia . '%' }}</td>
                        <td> {{ date('d/m/Y', strtotime($item->ngay_bat_dau)) }}</td>
                        <td> {{ date('d/m/Y', strtotime($item->ngay_ket_thuc)) }}</td>
                        <td> {!! $item->mo_ta !!}</td>
                        <td>
                                <a class="btn btn-success" style="color: #fff"
                                    href="{{ route('route_BE_Admin_Edit_Khuyen_Mai', ['id' => $item->id]) }}">
                                    <i class="fas fa-edit "></i> Sửa</a>
                        </td>
                        <td>

                                <a onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger" style="color: #fff"
                                    href="{{ route('route_BE_Admin_Xoa_Khuyen_Mai', ['id' => $item->id]) }}">
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
