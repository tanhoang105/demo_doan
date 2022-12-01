@extends('Admin.templates.layout')
@section('content')
    <div>
        @if (session()->has('sucssec'))
            <div class="alert alert-success">
                {{ session()->get('sucssec') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>
    <br>
    <div>
        <form method="GET" action="{{ route('route_BE_Admin_Add_doi_lop') }}">
            @csrf
            <a style="color: red" href="">
                <button class="btn btn-primary"> <i class="fas fa-plus "></i> Thêm</button>
            </a>
        </form>
    </div>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> <input id="check_all" type="checkbox" /></th>
                <th scope="col">STT</th>
                <th scope="col">Mã học viên </th>
                <th scope="col">Tên học viên </th>
                <th scope="col">Lớp cũ </th>
                <th scope="col">Lớp mới </th>
                <th scope="col">Khóa học cũ </th>
                <th scope="col">Khóa học mới </th>
                <th scope="col">Tiền nợ </th>
                <th scope="col">Trạng thái</th>
                <th style="text-align: center">Hành động </th>
                {{-- <th scope="col">Sửa</th> --}}
                {{-- <th scope="col">
                <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>

              </th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($doi_lop_khoa as $key => $item)
                <tr>
                    <td><input class="checkitem" type="checkbox" name="id[]" value="{{ $item->id }}" /></td>
                    <td> {{ $item->id }}</td>
                    <td> {{ $item->user_id }}</td>
                    <td> {{ $item->name }}</td>
                    <td>
                        <span hidden>{{ $id_lopcu = 0 }}</span>
                        @foreach ($data as $value)
                            @if ($item->id_lop_cu == $value->id)
                                <span hidden>{{ $id_lopcu = $item->id_lop_cu }}</span>
                                {{ $value->ten_lop }}
                            @endif
                        @endforeach
                    </td>
                    <td> {{ $item->ten_lop }}</td>
                    <td>
                        @foreach ($data as $value)
                            @if ($item->id_lop_cu == $value->id)
                                {{ $value->ten_khoa_hoc }}
                            @endif
                        @endforeach
                    </td>
                    <td> {{ $item->ten_khoa_hoc }}</td>
                    <td style="font-weight: bold">
                        @foreach ($data as $value)
                            @if ($item->id_lop_cu == $value->id)
                                @if ($value->gia_khoa_hoc - $item->gia_khoa_hoc >= 0)
                                    <span style="color: green">
                                        {{ number_format($value->gia_khoa_hoc - $item->gia_khoa_hoc) }} <sup>đ</sup>
                                    </span>
                                @elseif ($value->gia_khoa_hoc - $item->gia_khoa_hoc < 0)
                                    <span style="color: red">
                                        {{ number_format($value->gia_khoa_hoc - $item->gia_khoa_hoc) }} <sup>đ</sup>
                                    </span>
                                @endif
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if ($item->status == 0 || $item->status == 1)
                            <form action="{{ route('route_BE_Admin_updateStatus_doilop', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input hidden type="text" name="id_lopcu" value="{{ $id_lopcu }}" id="">
                                <input hidden type="text" name="id_lopmoi" value="{{ $item->lop_id }}" id="">
                                <input type="text" name="user_id" value="{{ $item->id_user }}" hidden id="">
                                <select {{ $item->status == 1 ? 'disabled' : '' }} style="height: 30px" name="status"
                                    id="">
                                    <option {{ $item->status == 0 ? 'selected' : '' }} value="0">Đang chờ xác nhận
                                    </option>
                                    <option {{ $item->status == 1 ? 'selected' : '' }} value="1">Đã xác nhận</option>
                                </select>
                                <button {{ $item->status == 1 ? 'disabled' : '' }} dis style="height: 30px;"
                                    class="btn btn-outline-info" type="submit"><i style=""
                                        class="fas fa-check"></i></button>
                            </form>
                        @endif
                        @if ($item->status == 2 || $item->status == 3 || $item->status == 4)
                            <form action="{{ route('route_BE_Admin_updateStatus_doilop', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input hidden type="text" name="id_lopcu" value="{{ $id_lopcu }}" id="">
                                <input hidden type="text" name="id_lopmoi" value="{{ $item->lop_id }}" id="">
                                <input type="text" name="user_id" value="{{ $item->id_user }}" hidden id="">
                                <select {{ $item->status == 4 ? 'disabled' : '' }} style="height: 30px" name="status"
                                    id="">
                                    <option {{ $item->status == 2 ? 'selected' : '' }} value="2">Đang chờ xác nhận
                                    </option>
                                    <option {{ $item->status == 3 ? 'selected' : '' }} value="3">Đã xác nhận</option>
                                    <option {{ $item->status == 4 ? 'selected' : '' }} value="4">Đã thanh toán
                                    </option>
                                </select>
                                <button {{ $item->status == 4 ? 'disabled' : '' }}
                                    onclick="return confirm('Bạn có chắc muốn thay đổi trạng thái?')" style="height: 30px;"
                                    class="btn btn-outline-info" type="submit"><i style=""
                                        class="fas fa-check"></i></button>
                            </form>
                        @endif
                    </td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Khoa_Hoc', ['id' => $item->id]) }}">
                                <i class="fas fa-trash-alt"></i> Xóa</a></button></td>

                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
