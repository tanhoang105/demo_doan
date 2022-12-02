@extends('Admin.templates.layout')
@section('content')
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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Vai_Tro') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên Vai Trò <span class="text-danger">*</span></label>
                    <input value="{{ old('ten_vai_tro') ?? request()->ten_vai_tro }}" type="text" name="ten_vai_tro"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_vai_tro')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô Tả</label>
                    <textarea class="form-control" name="mo_ta" id="mo_ta1"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_Vai_Tro')}} ">Quay lại </a>

    </form>
    {{-- <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta1');
    </script> --}}
@endsection
