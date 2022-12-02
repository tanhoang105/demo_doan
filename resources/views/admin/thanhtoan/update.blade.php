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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Thanh_Toan') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Ngày thanh toán</label>
                    <input value="{{ old('ngay_thanh_toan') ?? (request()->ngay_thanh_toan ?? $res->ngay_thanh_toan) }}"
                        type="date" name="ngay_thanh_toan" class="form-control" id=""
                        aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ngay_thanh_toan')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Phương thức thanh toán</label>
                    <select class="form-control" name="id_phuong_thuc_thanh_toan" id="">
                        @foreach ($phuongthucthanhtoan as $item)
                            @if ($item->id == $res->id_phuong_thuc_thanh_toan)
                                <option selected value="{{ $item->id }}">{{ $item->ten }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->ten }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('id_phuong_thuc_thanh_toan')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Giá</label>
                    <input class="form-control" type="text" name="gia" id="" value="{{ $res->gia }}">
                    @error('gia')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô tả</label>
                    <textarea class="form-control" type="text" name="mo_ta" id="">
                    @error('mo_ta')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{ route('route_BE_Admin_List_Thanh_Toan') }} ">Quay lại </a>


    </form>
@endsection
