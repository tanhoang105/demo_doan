@extends('Admin.templates.layout')

@section('form-search')
    {{ route('route_BE_Admin_List_Lich_Hoc') }}
@endsection

@section('content')
    <div class="row p-3">
        <a href="{{ route('route_BE_Admin_Add_Lop') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>
        </a>

        <a style="margin-left : 20px" href="{{ route('route_BE_Admin_List_Lich_Hoc') }}">
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


    <table class="table table-bordered">

        <thead>
            <tr>


                <th scope="col">STT</th>
                <th scope="col">Khóa học </th>
                <th scope="col">Tên Lớp </th>
                <th scope="col">Chi tiết</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                @foreach ($xepLop as $itemXepLop)
                    @if ($item->id_lop == $itemXepLop->id_lop)
                        <tr>

                            <th scope="row">{{ $loop->iteration }}</th>
                            <td> {{ $item->ten_khoa_hoc }}</td>
                            <td> {{ $item->ten_lop }}</td>


                            <td><button class="btn btn-primary"><a style="color: aliceblue"
                                        href=" {{ route('route_BE_Admin_Detail_Lich', ['id' => $item->id_lop]) }} ">Chi
                                        tiết</a></button></td>



                        </tr>
                    @endif
                @endforeach
            @endforeach

        </tbody>

    </table>

    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('params')->links() }}


        </div>

    </div>
@endsection
