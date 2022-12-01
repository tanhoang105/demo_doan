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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Ca_Hoc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Ca học </label>
                    <input value="{{ old('ca_hoc') ?? request()->ca_hoc }}" type="text" name="ca_hoc"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ca_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Thời gian bắt đầu</label>
                    <input value="{{ old('thoi_gian_bat_dau') ?? request()->thoi_gian_bat_dau }}" type="time" name="thoi_gian_bat_dau"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('thoi_gian_bat_dau')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Thời gian kết thúc</label>
                    <input value="{{ old('thoi_gian_ket_thuc') ?? request()->thoi_gian_ket_thuc }}" type="time" name="thoi_gian_ket_thuc"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('thoi_gian_ket_thuc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

            

        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>

    </form>
@endsection
