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
                    <label for="chuyenBay" class="form-label">Mã thứ</label>
                    <input value="{{ old('ma_thu') ?? request()->ma_thu }}" type="text"
                        name="ma_thu" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ma_thu')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>



                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên thứ</label>
                    <input class="form-control" type="text" name="ten_thu" id="">
                    @error('ten_thu')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô tả</label>
                    <textarea class="form-control" name="mo_ta" style="height: 125px;"></textarea>
                    @error('mo_ta')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('route_BE_Admin_List_Thu_Hoc') }}"><button type="button" class="btn btn-danger">Hủy</button></a>


    </form>
@endsection
