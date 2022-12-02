@extends('Admin.templates.layout')
@section('content')
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Hoc_Vien') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="" class="form-label">Tên tài khoản</label>
                    <input value="{{ old('name') ?? request()->name ?? $res->ten_hoc_vien }}" type="text" name="name" class="form-control"
                        id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('name')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Mật khẩu</label>
                    <input value="{{ old('password') ?? request()->name }}" type="password" name="password"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('password')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input value="{{ old('email') ?? request()->email ?? $res->email }}" type="email" name="email" class="form-control"
                        id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('email')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>


            <div class="col-6">

                <div class="mb-3">
                    <label for="" class="form-label">Số điện thoại</label>
                    <input type="text" name="sdt" id="" class="form-control" value=" {{ $res->sdt}} " >
                    @error('sdt')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Địa chỉ</label>
                    <input value="{{ old('dia_chi') ?? request()->dia_chi ?? $res->dia_chi      }}" type="text" name="dia_chi"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('dia_chi')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>




                <div class="mb-3">
                    <label for="" class="form-label">Avatar</label>
                    <td>
                        <img id="anh" style="border-radius: 100% ; width:100px ; height:100px "   src=" {{Storage::URL($res ->hinh_anh)}} " alt="">
                    </td>
                    <input  id="hinhanh" value="{{ old('hinh_anh') ?? request()->hinh_anh }}" type="file" name="hinh_anh"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('hinh_anh')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_List_Hoc_Vien')}} ">Quay lại </a>


    </form>
@endsection
