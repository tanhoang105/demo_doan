@extends('Admin.templates.layout')

@section('form-search')
    {{ route('route_BE_Admin_List_Dang_Ky') }}
@endsection

@section('content')
    <div class="row p-3">


        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Dang_Ky') }} "> <button class='btn btn-primary'> <i
                    class="fas fa-plus "></i> Thêm</button>
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
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Dang_Ky') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Ngày đăng ký</th>
                    <th scope="col">Người đăng ký</th>
                    <th scope="col">Lớp học đăng ký</th>
                    <th scope="col">Khóa học đăng ký</th>
                    <th scope="col">Học phí</th>
                    <th scope="col">Thanh toán</th>
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
                        <td> {{ date('d/m/Y', strtotime($item->ngay_dang_ky)) }}</td>
                        <td> {{ $item->ten_hoc_vien }}</td>
                        <td> {{ $item->ten_lop }}</td>
                        <td> {{ $item->ten_khoa_hoc }}</td>
                        <td> {{ number_format($item->gia_khoa_hoc, 0, '.', '.') . ' vnđ' }}</td>
                        <td>
                            @if ($item->trang_thai_thanh_toan == 2)
                                <button class="btn btn-primary">Đã thanh toán</button>
                            @elseif($item->trang_thai_thanh_toan == 1)
                                <button class="btn btn-warning">Chưa thanh toán</button>
                            @else
                                <button class="btn btn-danger">Đã hủy</button>
                            @endif
                        </td>


                        <td>
                            <a class="btn btn-warning" style="color: aliceblue"
                                href="{{ route('route_BE_Admin_Edit_Dang_Ky', ['id' => $item->id]) }}">
                                <i class="fas fa-edit "></i> Sửa</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"
                                style="color: aliceblue"
                                href="{{ route('route_BE_Admin_Xoa_Ca_Hoc', ['id' => $item->id]) }}">
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
