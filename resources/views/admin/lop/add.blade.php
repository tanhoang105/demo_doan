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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Lop') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên Lớp</label>
                    <input value="{{ old('ten_lop') ?? request()->ten_lop }}" type="text" name="ten_lop"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_lop')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Lịch học</label>
                    <select class="form-control" name="ca_thu_id" id="">
                        @foreach ($cathu as $item)
                            <option value="{{ $item->id }}">{{ $item->ca_id }}</option>
                        @endforeach
                    </select>
                    @error('ca_thu_id')  
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Khóa học</label>
                    <select class="form-control" name="id_khoa_hoc" id="">
                        @foreach ($khoahoc as $item)
                            <option value="{{ $item->id }}">{{ $item->ten_khoa_hoc }}</option>
                        @endforeach
                    </select>
                    @error('ten_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Giảng Viên</label>
                    <select class="form-control" name="id_giang_vien" id="">
                        @foreach ($giangvien as $item)
                            <option value="{{ $item->id }}">{{ $item->ten_giang_vien }}</option>
                        @endforeach
                    </select>
                    @error('ten_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                

                <div class="mb-3">
                    <label for="" class="form-label">Số ghế </label>
                    <input class="form-control" type="number" name="so_luong" id="">
                    @error('so_luong')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Ngày bắt đầu</label>
                    <input class="form-control" type="date" name="ngay_bat_dau" id="">
                    @error('ngay_bat_dau')
                    <span style="color: red"> {{ $message }} </span>
                @enderror
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Ngày kết thúc</label>
                    <input class="form-control" type="date" name="ngay_ket_thuc" id="">
                    @error('ngay_ket_thuc')
                    <span style="color: red"> {{ $message }} </span>
                @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>

    </form>
@endsection
