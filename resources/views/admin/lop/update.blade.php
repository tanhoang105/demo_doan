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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Lop') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="" class="form-label">Tên Lớp <span class="text-danger">*</span></label>
                    <input value="{{ old('ten_lop') ?? (request()->ten_lop ?? $lop->ten_lop) }}" type="text"
                        name="ten_lop" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_lop')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Khóa học <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_khoa_hoc" id="">
                        @foreach ($khoahoc as $item)
                            @if ($item->id == $lop->id_khoa_hoc)
                                <option selected value="{{ $item->id }}">{{ $item->ten_khoa_hoc }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->ten_khoa_hoc }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('id_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Giảng Viên <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_giang_vien" id="">
                      
                        @foreach ($giangvien as $item)
                            @if ($item->id == $lop->id_giang_vien)
                                <option selected value="{{ $item->id_user }}">{{ $item->ten_giang_vien }}</option>
                            @else
                                <option value="{{ $item->id_user }}">{{ $item->ten_giang_vien }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('id_giang_vien')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="col-6">
               

                <div class="mb-3">
                    <label for="" class="form-label">Số ghế <span class="text-danger">*</span></label>
                    <input value=" {{ $lop->so_luong }} " class="form-control" type="text" name="so_luong"
                        id="">
                    @error('so_luong')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

               

                <div class="mb-3">
                    <label for="" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                    <input value="{{ old('ngay_bat_dau') ?? $lop->ngay_bat_dau }}" type="date" name="ngay_bat_dau"
                        class="form-control" id="" aria-describedby="">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ngay_bat_dau')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                    <input value="{{ old('ngay_ket_thuc') ?? $lop->ngay_ket_thuc ?? request()->ngay_ket_thuc}}" type="date" name="ngay_ket_thuc"
                        class="form-control" id="" aria-describedby="">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ngay_ket_thuc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập Nhập</button>
        <a class="btn btn-danger" href=" {{ route('route_BE_Admin_List_Lop') }} ">Hủy</a>

    </form>
@endsection
