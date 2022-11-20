@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <a href="{{ route('route_BE_Admin_Xep_Lop') }}">
            <button class='btn btn-success'>Quay Lại</button>
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
    <table class="table table-bordered">

        <thead>
            <tr>
                <th scope="col">STT</th>

                <th scope="col">Tên Lớp </th>
                {{-- <th scope="col">Ca học </th> --}}
                <th scope="col">Số lượng học viên </th>
                <th scope="col">Ngày bắt đầu </th>
                <th scope="col">Ngày kết thúc </th>
                <th scope="col">Giảng viên </th>
               
            </tr>
        </thead>
        <tbody>

            <tr>
                <th scope="row">1</th>
                <td> {{ $item->ten_lop }}</td>

                {{-- <td>
                    @foreach ($cahoc as $ca)
                        @if ($ca->id == $item->id_ca_hoc)
                            {{ $ca->ca_hoc }}
                        @endif
                    @endforeach
                </td> --}}
                {{-- <td> {{ $item->id_ca_hoc }}</td> --}}
             
                <td> {{ $item->so_luong }}</td>
                <td> {{ $item->ngay_bat_dau }}</td>
                <td> {{ $item->ngay_ket_thuc }}</td>
                <td>
                    @foreach ($giangvien as $gv)
                        @if ($item->id_giang_vien == $gv->id)
                            {{ $gv->ten_giang_vien }}
                        @endif
                    @endforeach
                </td>
                {{-- <td> {{ $item->ten_phong }}</td> --}}

                {{-- <td> <button class="btn btn-warning">
                            <a href="{{ route('route_BE_Admin_Edit_Lop', ['id' => $item->id_lop]) }}"> Sửa
                            </a>
                        </button>
                    </td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Lop', ['id' => $item->id_lop]) }}">
                                Xóa</a></button></td> --}}

            </tr>


        </tbody>

    </table>
@endsection
