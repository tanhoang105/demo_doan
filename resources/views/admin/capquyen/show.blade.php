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
    <div class="col-6 p-5" >

        <div class="mb-3">
            <label for="" class="form-label">Tên tài khoản : </label>
            <span>{{ $user->name }}</span>

            <label style="margin-left: 20px" for="" class="form-label">   Vai trò: </label>
            <span>{{ $vaitro->ten_vai_tro }}</span>
            <div>
                <label for="" class="form-label">Quyền</label>
                <form action="{{ route('route_BE_Admin_Update_Cap_Quyen') }} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        @foreach ($quyen as $item)
                            
                                <div>
                                    <input <?php foreach ($q as $key => $value) {
                                        if($value->ten == $item->ten){
                                            echo 'checked';
                                        }
                                    }  ?>  type="checkbox" name="cho_phep[]" id="" value=" {{ $item->id }} ">
                                    {{ $item->ten }}
                                </div>
                         
                        @endforeach
                    </div><br>
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
