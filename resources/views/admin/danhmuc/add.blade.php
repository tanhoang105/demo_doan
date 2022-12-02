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
    <form class="p-5" action=" {{ route('route_Admin_BE_Add_Danh_Muc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
     
                <div class="mb-3">
                    <label for="" class="form-label">Tên danh mục</label>
                    <input value="{{ old('ten_danh_muc') ?? request()->ten_danh_muc }}" type="text"
                        name="ten_danh_muc" class="form-control" id="" aria-describedby="emailHelp">
                        {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_danh_muc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_Admin_BE_Danh_Muc_Khoa_Hoc')}} ">Quay lại </a>
          
    </form>


@endsection
