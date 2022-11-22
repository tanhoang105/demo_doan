@extends('Admin.templates.layout')
@section('content')
<form class="p-5" action=" {{ route('route_BE_Admin_Add_Khoa_Hoc') }}" method="post" enctype="multipart/form-data">
    <div class="row">
        @csrf
        <div class="col-6">

            <div class="mb-3">
                <label for="chuyenBay" class="form-label">Tên Khóa Học</label>
                <input value="{{ old('ten_khoa_hoc') ?? request()->ten_khoa_hoc }}" type="text" name="ten_khoa_hoc"
                    class="form-control" id="" aria-describedby="emailHelp">
                {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                @error('ten_khoa_hoc')
                    <span style="color: red"> {{ $message }} </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="chuyenBay" class="form-label">Danh Mục</label>
                <select class="form-control" name="id_danh_muc" id="">
                    @foreach ($danhmuc as $item)
                        <option value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                    @endforeach
                </select>
                {{-- @error('ten_khoa_hoc')
                    <span style="color: red"> {{ $message }} </span>
                @enderror --}}
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="" class="form-label">Ảnh</label>
                <input value="{{ old('hinh_anh') ?? request()->hinh_anh }}" type="file" name="hinh_anh"
                    class="form-control" id="" aria-describedby="emailHelp">
                {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                @error('hinh_anh')
                    <span style="color: red"> {{ $message }} </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Mô Tả</label>
                <textarea id="ckeditor2" class="form-control" name="mo_ta" id="" ></textarea>
                @error('mo_ta')
                <span style="color: red"> {{ $message }} </span>
            @enderror
            </div>


        </div>

    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
@endsection
