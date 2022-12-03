@extends('Admin.templates.layout')

@section('form-search')
    {{ route('route_BE_Admin_List_Lop') }}
@endsection

@section('content')
    <div class="row p-3">
        <a href="{{ route('route_BE_Admin_Add_Lop') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>
        </a>
        <a style="margin-left: 10px" href="{{ route('route_BE_Admin_List_Lop') }}">
            <button class='btn btn-warning'> Tất cả danh sách</button>
        </a>
    </div>
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
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
    <form action="" method="get">
        @csrf
        <div class="row p-3">
            <div class="col-2">
                <select class="form-control" name="khoa_hoc" id="">
                    <option value="">Lọc theo khóa học</option>
                    @foreach ($khoa_hoc as $itemKhoaHoc)
                        <option value=" {{ $itemKhoaHoc->id }} "> {{ $itemKhoaHoc->ten_khoa_hoc }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <input type="date" class="form-control" placeholder="ngày bắt đầu" name="ngay_bat_dau">
            </div>

            <div class="col-2">
                <select class="form-control" name="giang_vien" id="">
                    <option value="">Lọc theo giảng viên</option>

                    @foreach ($giang_vien as $itemGiangVien)
                        <option value=" {{ $itemGiangVien->id_user }} "> {{ $itemGiangVien->ten_giang_vien }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-3">
                <select class="form-control" name="ca_thu" id="">
                    <option value=""> Lọc theo lich </option>
                    @foreach ($listcathu as $item)
                        <option value="{{ $item->id }}">


                            @foreach ($cahoc as $itemCa)
                                {{-- {{$itemCa->ca_hoc}} --}}
                                @if ($item->ca_id == $itemCa->id)
                                    {{ $itemCa->ca_hoc . ' ( ' . $itemCa->thoi_gian_bat_dau . ' - ' . $itemCa->thoi_gian_ket_thuc . ' ) ' . ' : ' }}
                                @else
                                    {{ '' }}
                                @endif
                            @endforeach



                            <?php
                            
                            for ($i = 0; $i < count([$item->thu_hoc_id]); $i++) {
                                $str = explode(',', $item->thu_hoc_id);
                            }
                            
                            for ($i = 0; $i < count($str); $i++) {
                                foreach ($thu as $key => $value) {
                                    $count = count($str) - 1;
                                    if ($i == $count) {
                                        if ($str[$i] == $value->id) {
                                            echo $value->ten_thu . ' ';
                                        }
                                    } else {
                                        if ($str[$i] == $value->id) {
                                            echo $value->ten_thu . ' & ';
                                        }
                                    }
                                }
                            }
                            
                            ?>
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="col-2">
                <select class="form-control" name="" id="">
                    @foreach ($khoa_hoc as $itemKhoaHoc)
                        <option value=" {{ $itemKhoaHoc->id }} "> {{ $itemKhoaHoc->ten_khoa_hoc }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-1">
                <select class="form-control" name="" id="">
                    @foreach ($khoa_hoc as $itemKhoaHoc)
                        <option value=" {{ $itemKhoaHoc->id }} "> {{ $itemKhoaHoc->ten_khoa_hoc }} </option>
                    @endforeach
                </select>
            </div> --}}

            <div class="col-1">
                <button class="btn btn-success">Lọc</button>
            </div>
        </div>
    </form>
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Lop') }}" enctype="multipart/form-data">
        @csrf

        <table class="table table-bordered">

            <thead>
                <tr>

                    <th scope="col">
                        <input id="check_all" type="checkbox" />
                        {{-- <button style="margin-bottom: 10px" type="submit" class="btn" style=""><i class="fas fa-trash-alt"></i></button> --}}
                    </th>
                    <th scope="col">STT</th>
                    <th scope="col">Khóa học </th>
                    <th scope="col">Tên Lớp </th>
                    <th scope="col">Số lượng học viên </th>
                    <th scope="col">Ngày bắt đầu </th>
                    <th scope="col">Ngày kết thúc </th>
                    <th scope="col">Chi tiết lịch học</th>
                    <th scope="col">Giảng viên </th>
                    <th scope="col">Sửa</th>
                    <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $item)
                    <tr>
                        <td><input class="checkitem" type="checkbox" name="id[]" value="{{ $item->id_lop }}" /></td>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td> {{ $item->ten_khoa_hoc }}</td>
                        <td> {{ $item->ten_lop }}</td>

                        <td> {{ $item->so_luong }}</td>
                        <td> {{ $item->ngay_bat_dau }}</td>
                        <td> {{ $item->ngay_ket_thuc }}</td>
                        <td>
                            <a class="bt btn-primary" style="color: aliceblue ; padding:5px"
                                href=" {{ route('route_BE_Admin_Detail_Lop', ['id' => $item->id_lop]) }} ">Chi
                                tiết</a>
                        </td>
                        <td>
                            @foreach ($giangvien as $gv)
                                {{-- {{$gv->ten_giang_vien}} --}}
                                @if ($gv->id_user == $item->id_giang_vien)
                                    {{ $gv->ten_giang_vien }}
                                    {{-- @else
                                <button class="btn success"><a href="">Thêm giảng viên</a></button>     --}}
                                @endif
                            @endforeach
                        </td>
                        <td>

                            <a class="btn btn-success" style="color: aliceblue"
                                href="{{ route('route_BE_Admin_Edit_Lop', ['id' => $item->id_lop]) }}">
                                <i class="fas fa-edit "></i>Sửa</a>

                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"
                                style="color: aliceblue"
                                href="{{ route('route_BE_Admin_Xoa_Lop', ['id' => $item->id_lop]) }}">
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
