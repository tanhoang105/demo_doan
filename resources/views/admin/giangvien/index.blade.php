@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_BE_Admin_List_Giang_Vien') }}
@endsection

@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Giang_Vien') }}">
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

    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Giang_Vien') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        <input id="check_all" type="checkbox" />
                        {{-- <button type="submit" class="btn" style="">Xóa</button> --}}
                    </th>
                    <th scope="col">STT</th>
                    <th scope="col">Tên giảng viên </th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Địa chỉ </th>
                    <th scope="col">Email </th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $item)
                    <tr>
                        {{-- value="{{ $item->id_user }}" --}}
                        <td><input {{in_array($item->id_user , $arrayIdGiangVienCuaLop) == true ? 'hidden' : 'value=' . $item->id_user }} class="checkitem" type="checkbox" name="id[]" /></td>
                        <th scope="row"> {{ $loop->iteration }}</th>
                        <td> {{ $item->ten_giang_vien }}</td>
                        <td>
                            <img width="50px" height="50px " style="border-radius:100%" src="{{Storage::url($item->hinh_anh)}}" alt="">
                        </td>
                        <td> {{ $item->dia_chi_giang_vien }}</td>
                        <td> {{ $item->email_giang_vien }}</td>
                        <td>
                            {{ $item->sdt_giang_vien }}
                        </td>
                        <td>
                           
                                <a class="btn btn-success" style="color: #fff" href="{{ route('route_BE_Admin_Edit_Giang_Vien', ['id' => $item->id_user]) }}">
                                    <i class="fas fa-edit "></i> Sửa</a>
                            
                        </td>
                        <td>
                            
                                <a {{in_array($item->id_user , $arrayIdGiangVienCuaLop) == true ? 'hidden' : '' }}  onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger" style="color: #fff" href="{{ route('route_BE_Admin_Xoa_Giang_Vien', ['id' => $item->id_user]) }}">
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
