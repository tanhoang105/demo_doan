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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Phong_Hoc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên Phòng Học</label>
                    <input value="{{ old('ten_phong') ?? request()->ten_phong ?? $phonghoc->ten_phong }}" type="text" name="ten_phong"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_phong')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>                
            </div>

            <div class="col-6">
          
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô Tả</label>
                    <textarea class="form-control" name="mo_ta" id="" > {{$phonghoc->mo_ta}} </textarea>
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập Nhập</button>

    </form>
@endsection
