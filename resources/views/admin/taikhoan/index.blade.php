@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_BE_Admin_Tai_Khoan') }}
@endsection

@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Tai_Khoan') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>
        </a>
        <a style="margin-left: 10px" href="{{ route('route_BE_Admin_Tai_Khoan') }}">
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
    <form action="" method="get">
        @csrf
        <div class="row p-3">
            <div class="col-2">
                <select class="form-control" name="vai_tro" id="">
                    <option value="">Lọc theo vai tro</option>
                    @foreach ($vaitro as $itemVaiTro)
                        <option value=" {{ $itemVaiTro->id }} "> {{ $itemVaiTro->ten_vai_tro }} </option>
                    @endforeach
                </select>
            </div>


            {{-- <div class="col-2">
                <select class="form-control" name="giang_vien" id="">
                    <option value="">Lọc theo giảng viên</option>

                    @foreach ($giang_vien as $itemGiangVien)
                        <option value=" {{ $itemGiangVien->id_user }} "> {{ $itemGiangVien->ten_giang_vien }} </option>
                    @endforeach
                </select>
            </div> --}}



            <div class="col-1">
                <button class="btn btn-success">Lọc</button>
            </div>

        </div>
    </form>
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Tai_Khoan') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Tên </th>
                    <th scope="col">Email</th>
                    <th scope="col">Vai trò </th>
                    <th scope="col">Avatar </th>
                    <th scope="col">Sửa</th>
                    <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $item)
                    <tr>
                        <td>
                            @if ($item->vai_tro_id != 1)
                                <input
                                    {{ in_array($item->id, $arrayIdGiangVienCuaLop) == true ? 'hidden' : 'value=' . $item->id }}
                                    class="checkitem" type="checkbox" name="id[]" />
                        </td>
                @endif
                <th scope="row"> {{ $loop->iteration }}</th>
                <td> {{ $item->name }}</td>
                <td> {{ $item->email }}</td>
                <td>
                    @foreach ($vaitro as $res)
                        @if ($res->id == $item->vai_tro_id)
                            {{ $res->ten_vai_tro }}
                        @endif
                    @endforeach
                </td>

                <td>
                    <img style="border-radius: 100% ; width:100px ; height:100px "
                        src=" {{ Storage::URL($item->hinh_anh) }} " alt="">
                </td>

                <td>
                    {{-- <button class="btn btn-success"> --}}
                    <a style="color: aliceblue " class="btn btn-success"
                        href="{{ route('route_BE_Admin_Edit_Tai_Khoan', ['id' => $item->id]) }}">
                        <i class="fas fa-edit "></i> Sửa </a>
                    {{-- </button> --}}
                </td>
                <td>

                    {{-- <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"> --}}
                    <a {{ $item->vai_tro_id == 1 ? 'hidden' : '' }}
                        {{ in_array($item->id, $arrayIdGiangVienCuaLop) == true ? 'hidden' : '' }}
                        onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger" style="color: aliceblue"
                        href="{{ route('route_BE_Admin_Xoa_Tai_Khoan', ['id' => $item->id]) }}">
                        <i class="fas fa-trash-alt"></i> Xóa </a>
                    {{-- </button> --}}
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
