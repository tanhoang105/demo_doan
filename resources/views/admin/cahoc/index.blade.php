@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <a style="color: red" href="{{ route('route_BE_Admin_Add_Ca_Hoc') }} ">
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

    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Ca_Hoc') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Ca học</th>
                    <th scope="col">Thời gian bắt đầu</th>
                    <th scope="col">Thời gian kết thúc</th>
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
                        <td> {{ $item->ca_hoc }}</td>
                        <td> {{ $item->thoi_gian_bat_dau }}</td>
                        <td> {{ $item->thoi_gian_ket_thuc }}</td>

                        <td>
                            <button class="btn btn-success">
                                <a style="color: aliceblue" href="{{ route('route_BE_Admin_Edit_Ca_Hoc', ['id' => $item->id]) }}">
                                    <i class="fas fa-edit "></i> Sửa</a>
                            </button>
                        </td>
                        <td>
                            <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger">
                                <a style="color: aliceblue" href="{{ route('route_BE_Admin_Xoa_Ca_Hoc', ['id' => $item->id]) }}">
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
