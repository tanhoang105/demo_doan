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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Thanh_Toan') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Ngày thanh toán <span class="text-danger">*</span></label>
                    <input value="{{ old('ngay_thanh_toan') ?? request()->ngay_thanh_toan }}" type="date"
                        name="ngay_thanh_toan" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ngay_thanh_toan')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Phương thức thanh toán <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_phuong_thuc_thanh_toan" id="">
                            <option value="0">--- Chọn phương thức thanh toán ---</option>
                        @foreach ($phuongthucthanhtoan as $item)
                            <option value="{{ $item->id }}">{{ $item->ten }}</option>
                        @endforeach
                    </select>
                    @error('id_phuong_thuc_thanh_toan')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Giá <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="gia" id="">
                    @error('gia')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô tả</label>
                    <input class="form-control" type="text" name="mo_ta" id="">
                    @error('mo_ta')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{ route('route_BE_Admin_List_Thanh_Toan') }} ">Quay lại </a>


    </form>

@endsection
