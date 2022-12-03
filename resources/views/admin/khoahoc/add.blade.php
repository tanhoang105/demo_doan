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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Khoa_Hoc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên Khóa Học <span class="text-danger">*</span></label>
                    <input value="{{ old('ten_khoa_hoc') ?? request()->ten_khoa_hoc }}" type="text" name="ten_khoa_hoc"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Danh Mục <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_danh_muc" id="">
                            <option value="0">--- Chọn danh mục khóa học ---</option>
                        @foreach ($danhmuc as $item)
                            <option value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                        @endforeach
                    </select>
                    @error('id_danh_muc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Giá Khóa Học <span class="text-danger">*</span></label>
                    <input value="{{ old('gia_khoa_hoc') ?? request()->gia_khoa_hoc }}" type="text" name="gia_khoa_hoc"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('gia_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="" class="form-label">Ảnh</label><br>
                    {{--                    <img width="200px" id="anh" src="" alt=""><br> --}}
                    <img id="anh" src="{{ asset('custom/images/avatar-01.png') }}" style="border-radius: 100%"
                        width="100px" height="100px" alt="">

                    <input id="hinhanh" value="{{ old('hinh_anh') ?? request()->hinh_anh }}" type="file"
                        name="hinh_anh" class="form-control" accept=".png, .jpg, .jpeg">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('hinh_anh')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Mô Tả</label>
                    <textarea id="ckeditor2" class="form-control" name="mo_ta" id=""></textarea>
                    @error('mo_ta')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_Khoa_Hoc')}} ">Quay lại </a>


    </form>
    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor2');
    </script>
@endsection
