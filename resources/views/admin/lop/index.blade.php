@extends('Admin.templates.layout')

@section('form-search')
    {{route('route_BE_Admin_List_Lop')}}
@endsection

@section('content')
    <div class="row p-3">
        <a href="{{ route('route_BE_Admin_Add_Lop') }}">
            <button class='btn btn-primary'>  <i class="fas fa-plus "></i> Thêm</button>
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
                        <td><button class="bt btn-primary"><a style="color: aliceblue" href=" {{route('route_BE_Admin_Detail_Lop' , ['id'=>$item->id_lop])}} ">Chi tiết</a></button></td>
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
                            <a href="{{ route('route_BE_Admin_Edit_Lop', ['id' => $item->id_lop]) }}">
                                <button class="btn btn-success">
                                <i class="fas fa-edit "></i>Sửa</button></a>
                        </td>
                        <td>
                            <a href="{{ route('route_BE_Admin_Xoa_Lop', ['id' => $item->id_lop]) }}">
                                <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Xóa</button></a>
                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>
    </form>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('params')->links() }}
            <div class="d-flex flex-row-reverse align-items-center justify-content-between flex-wrap">
                <button style="margin-right : 55px" class="btn btn-light"><a
                        href=" {{ route('route_BE_Admin_List_Lop', ['checkgv' => 1]) }} ">
                        Lớp chưa có giảng viên</a></button>
                <button style="margin-right : 55px" class="btn btn-light"><a
                        href=" {{ route('route_BE_Admin_List_Lop', ['checkgv' => 2]) }}">
                        Lớp có giảng viên</a></button>
                <button style="margin-right : 55px" class="btn btn-light"><a

                        href=" {{ route('route_BE_Admin_List_Lop') }}">
                        Tất cả lớp học</a></button>

            </div>

        </div>

    </div>
@endsection
