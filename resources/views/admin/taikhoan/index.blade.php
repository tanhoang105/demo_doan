@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <button class="btn btn-primary"><a style="color: red"
                                           href=" {{ route('route_BE_Admin_Add_Tai_Khoan') }}">Thêm</a></button>
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
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên </th>
            <th scope="col">Email</th>
            <th scope="col">Vai trò </th>
            <th scope="col">Avatar </th>
            <th scope="col">Sửa</th>
            <th scope="col">Xóa </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $key => $item)
            <tr>
                <th scope="row"> {{ $loop->iteration }}</th>
                <td> {{ $item->name }}</td>

                <td> {{ $item->email }}</td>
                <td>
                    @foreach($vaitro as $res)
                        @if($res->id  ==  $item->vai_tro_id )
                            {{ $res->ten_vai_tro }}

                        @endif
                    @endforeach
                </td>

                <td>
                    <img style="border-radius: 100% ; width:100px ; height:100px "   src=" {{Storage::URL($item ->hinh_anh)}} " alt="">
                </td>

                <td> <button class="btn btn-warning"><a
                            href="{{ route('route_BE_Admin_Edit_Tai_Khoan', ['id' => $item->id]) }}"> Sửa
                        </a></button></td>
                <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                            href="{{ route('route_BE_Admin_Xoa_Tai_Khoan', ['id' => $item->id]) }}">
                            Xóa</a></button></td>

            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('params')->links() }}
        </div>
    </div>
@endsection
