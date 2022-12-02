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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Thu_Hoc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mã thứ <span class="text-danger">*</span></label>
                    <input value="{{ old('ma_thu') ?? request()->ma_thu }}" type="text"
                        name="ma_thu" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ma_thu')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>



                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên thứ <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="ten_thu" value="{{ old('ten_thu') ?? request()->ten_thu }}">
                    @error('ten_thu')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('route_BE_Admin_List_Thu_Hoc') }}"><button type="button" class="btn btn-danger">Hủy</button></a>

            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô tả</label>
                    <textarea class="form-control" name="mo_ta" id="content" style="height: 125px;"></textarea>
                    @error('mo_ta')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a class="btn btn-danger" href="{{ route('route_BE_Admin_List_Thu_Hoc') }}">Hủy</a>


    </form>

    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
