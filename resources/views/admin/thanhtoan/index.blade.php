@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_BE_Admin_List_Thanh_Toan') }}
@endsection
@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Thanh_Toan') }}">
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
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Thanh_Toan') }}" enctype="multipart/form-data">

        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Phương thức thanh toán </th>
                    <th scope="col">Ngày thanh toán</th>
                    <th scope="col">Tiền thanh toán</th>
                    {{-- <th scope="col">In hóa đơn</th> --}}
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
                        <td>
                            @foreach ($phuongthucthanhtoan as $value)
                                @if ($value->id == $item->id_phuong_thuc_thanh_toan)
                                    {{ $value->ten }}
                                @endif
                            @endforeach


                        </td>
                        <td> {{ $item->ngay_thanh_toan }}</td>
                        <td> {{ number_format($item->gia, 0, '.', ',') }}</td>
                        {{-- <td>
                            <a class="btn btn-primary" style="color: #fff"
                                href=" {{ route('route_BE_Admin_In_Hoa_Don', ['id' => $item->id]) }} ">
                                In</a>
                        </td> --}}
                        <td>
                            <a class="btn btn-success" style="color: #fff"
                                href="{{ route('route_BE_Admin_Edit_Thanh_Toan', ['id' => $item->id]) }}">
                                <i class="fas fa-edit "></i> Sửa</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger" style="color: #fff"
                                href="{{ route('route_BE_Admin_Xoa_Thanh_Toan', ['id' => $item->id]) }}">
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
