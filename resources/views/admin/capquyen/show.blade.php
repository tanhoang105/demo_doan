@extends('Admin.templates.layout')
@section('content')
    {{-- <div class="row p-3">
        <a style="color: red" href=" {{ route('route_Admin_BE_Add_Danh_Muc') }}">
            <button class='btn btn-success'> <i class="fas fa-plus "></i> Thêm</button>

        </a>
    </div> --}}
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
    <div class="col-12 p-5">

        <div class="mb-3">
            {{-- <label for="" class="form-label">Tên tài khoản : </label>
            <span>{{ $user->name }}</span> --}}

            <label style="" for="" class="form-label"> Vai trò: </label>
            <span style="font-weight:800 ; font-size:20px">{{ $vaitro->ten_vai_tro }}</span>
            <div>
                <label for="" class="form-label">Quyền</label>
                <input id="check_all" type="checkbox" />
                <form action="{{ route('route_BE_Admin_Update_Cap_Quyen') }} " method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="row">
                        <div class="col-12 p-2">Modul phân quyền</div>
                        @foreach ($quyen as $item)
                            @if ($item->trang_thai == 2)
                                <div class="col-3">

                                    <input <?php foreach ($q as $key => $value) {
                                        if ($value->ten == $item->ten) {
                                            echo 'checked';
                                        }
                                    } ?> type="checkbox" class="checkitem" name="cho_phep[]"
                                        id="" value=" {{ $item->id }} ">
                                    {{ $item->ten }}
                                </div>
                            @endif
                        @endforeach
                    </div><br>

                    <div class="row">
                        <div class="col-12 p-2">Modul tài khoản</div>
                        @foreach ($quyen as $item)
                            @if ($item->trang_thai == 3)
                                <div class="col-3">

                                    <input <?php foreach ($q as $key => $value) {
                                        if ($value->ten == $item->ten) {
                                            echo 'checked';
                                        }
                                    } ?> type="checkbox" class="checkitem" name="cho_phep[]"
                                        id="" value=" {{ $item->id }} ">
                                    {{ $item->ten }}
                                </div>
                            @endif
                        @endforeach
                    </div><br>

                    <div class="row">
                        <div class="col-12 p-2">Modul tài khoản</div>
                        @foreach ($quyen as $item)
                            @if ($item->trang_thai == 4)
                                <div class="col-3">

                                    <input <?php foreach ($q as $key => $value) {
                                        if ($value->ten == $item->ten) {
                                            echo 'checked';
                                        }
                                    } ?> type="checkbox" class="checkitem" name="cho_phep[]"
                                        id="" value=" {{ $item->id }} ">
                                    {{ $item->ten }}
                                </div>
                            @endif
                        @endforeach
                    </div><br>

                    <div class="row">
                        <div class="col-12 p-2">Modul tài khoản</div>
                        @foreach ($quyen as $item)
                            @if ($item->trang_thai == 5)
                                <div class="col-3">

                                    <input <?php foreach ($q as $key => $value) {
                                        if ($value->ten == $item->ten) {
                                            echo 'checked';
                                        }
                                    } ?> type="checkbox" class="checkitem" name="cho_phep[]"
                                        id="" value=" {{ $item->id }} ">
                                    {{ $item->ten }}
                                </div>
                            @endif
                        @endforeach
                    </div><br>

                    <div class="row">
                        <div class="col-12 p-2">Modul tài khoản</div>
                        @foreach ($quyen as $item)
                            @if ($item->trang_thai == 6)
                                <div class="col-3">

                                    <input <?php foreach ($q as $key => $value) {
                                        if ($value->ten == $item->ten) {
                                            echo 'checked';
                                        }
                                    } ?> type="checkbox" class="checkitem" name="cho_phep[]"
                                        id="" value=" {{ $item->id }} ">
                                    {{ $item->ten }}
                                </div>
                            @endif
                        @endforeach
                    </div><br>


                    <div class="row">
                        <div class="col-12 p-2">Modul tài khoản</div>
                        @foreach ($quyen as $item)
                            @if ($item->trang_thai == 7)
                                <div class="col-3">

                                    <input <?php foreach ($q as $key => $value) {
                                        if ($value->ten == $item->ten) {
                                            echo 'checked';
                                        }
                                    } ?> type="checkbox" class="checkitem" name="cho_phep[]"
                                        id="" value=" {{ $item->id }} ">
                                    {{ $item->ten }}
                                </div>
                            @endif
                        @endforeach
                    </div><br> --}}

                    @for ($i = 2; $i <= 17; $i++)
                    <div class="row">
                        <div class="col-12 p-2">Modul</div>
                        @foreach ($quyen as $item)
                            @if ($item->trang_thai == $i)
                                <div class="col-3">

                                    <input <?php foreach ($q as $key => $value) {
                                        if ($value->ten == $item->ten) {
                                            echo 'checked';
                                        }
                                    } ?> type="checkbox" class="checkitem" name="cho_phep[]"
                                        id="" value=" {{ $item->id }} ">
                                    {{ $item->ten }}
                                </div>
                            @endif
                        @endforeach
                    </div><br>
                    @endfor






                    <button class="btn btn-primary" type="submit">Cấp quyền</button>
                </form>
            </div>
        </div>
    </div>


    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{-- {{ $list->appends('params')->links() }} --}}
        </div>
    </div>
@endsection
