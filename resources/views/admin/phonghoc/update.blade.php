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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Phong_Hoc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên Phòng Học <span class="text-danger">*</span></label>
                    <input value="{{ old('ten_phong') ?? (request()->ten_phong ?? $phonghoc->ten_phong) }}" type="text"
                        name="ten_phong" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_phong')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhập</button>
                <a href="{{ route('route_BE_Admin_Phong_Hoc') }}">
                <button type="button" class="btn btn-danger">Hủy</button></a>

            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô Tả</label>
                    <textarea class="form-control" name="mo_ta" id="content2"> {{ $phonghoc->mo_ta }} </textarea>
                </div>
            </div>
            <input type="text" name="dia_chi" id="" hidden value="hà nội">
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhập</button>
        <a btn btn-danger href="{{ route('route_BE_Admin_Phong_Hoc') }}">
            Hủy</a>

    </form>
    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content2');
    </script>
@endsection
