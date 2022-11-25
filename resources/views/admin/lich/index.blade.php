@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_BE_Admin_List_Lich_Hoc') }}
@endsection
@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Lich_Hoc') }}">
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
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Lich_Hoc') }}" enctype="multipart/form-data">

        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <i class="fa-solid fa-circle-play"></i> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Thứ</th>
                    <th scope="col">Ngày</th>
                    <th scope="col">Phòng</th>
                    <th scope="col">Khóa hoc</th>
                    <th scope="col">Lớp</th>
                    <th scope="col">Giảng viên</th>
                    <th scope="col">Ca</th>
                    <th scope="col">Thời gian</th>
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
                            @foreach ($thu as $itemThu)
                                @if ($item->ma_thu == $itemThu->ma_thu)
                                    {{ $itemThu->ten_thu }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            {{ $item->ngay_hoc }}
                        </td>

                        <td>
                            @foreach ($phong as $itemPhongHoc)
                                @if ($item->id_phong_hoc == $itemPhongHoc->id)
                                    {{ $itemPhongHoc->ten_phong }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach ($khoahoc as $itemKhoaHoc)
                                @if ($item->id_khoa_hoc == $itemKhoaHoc->id)
                                    {{ $itemKhoaHoc->ten_khoa_hoc }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach ($lop as $itemLop)
                                @if ($item->id_lop == $itemLop->id)
                                    {{ $itemLop->ten_lop }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach ($giangvien as $itemGiangVien)
                                @if ($item->id_giang_vien == $itemGiangVien->id_user)
                                    {{ $itemGiangVien->ten_giang_vien }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach ($ca as $itemCa)
                                @if ($item->ca_id == $itemCa->id)
                                    {{ $itemCa->ca_hoc }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            {{ $item->thoi_gian_bat_dau . ' - ' . $item->thoi_gian_ket_thuc }}
                        </td>


                        <td>
                            <button class="btn btn-success">
                                <a style="color:#fff" href="{{ route('route_BE_Admin_Edit_Lich_Hoc', ['id' => $item->id]) }}">
                                    <i class="fas fa-edit "></i> Sửa</a>

                            </button>
                        </td>
                        <td>
                            <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger">
                                <a style="color:#fff" href="{{ route('route_BE_Admin_Xoa_Lich_Hoc', ['id' => $item->id]) }}">
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
