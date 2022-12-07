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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Khoa_Hoc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên Khóa Học <span class="text-danger">*</span></label>
                    <input value="{{ old('ten_khoa_hoc') ?? $khoahoc->ten_khoa_hoc }}" type="text" name="ten_khoa_hoc"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Danh Mục <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_danh_muc" id="">
                        @foreach ($danhmuc as $item)
                            @if ($item->id == $khoahoc->id_danh_muc)
                                <option selected value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                            @endif
                        @endforeach
                    </select>

                    <div class="mb-3">
                        <label for="chuyenBay" class="form-label">Giá Khóa Học <span class="text-danger">*</span></label>
                        <input value="{{ old('gia_khoa_hoc') ?? request()->gia_khoa_hoc ?? $khoahoc->gia_khoa_hoc }}" type="text" name="gia_khoa_hoc"
                            class="form-control" id="" aria-describedby="emailHelp">
                        {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                        @error('gia_khoa_hoc')
                            <span style="color: red"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô Tả</label>
                    <textarea id="ckeditor3" class="form-control" name="mo_ta" id="">{{$khoahoc->mo_ta}}</textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Ảnh</label>
                    <input value="{{ old('hinh_anh') ?? $khoahoc->hinh_anh }}" type="file" name="hinh_anh"
                    class="form-control" id="" onchange="loadFile(event)">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    <img class="pt-3" src="{{ Storage::url($khoahoc->hinh_anh)}}" id="preview" alt="" style="width: 580px;height: 350px;"><br>
                    @error('hinh_anh')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_Khoa_Hoc')}} ">Quay lại </a>

    </form>
    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor3');
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script>
        var loadFile = function(event) {;
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
