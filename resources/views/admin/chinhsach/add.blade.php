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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Chinh_Sach') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
     
                <div class="mb-3">
                    <label for="" class="form-label">Tối tượng áp dụng</label>
                    <input value="{{ old('doi_tuong_ap_dung') ?? request()->doi_tuong_ap_dung }}" type="text"
                        name="doi_tuong_ap_dung" class="form-control" id="" aria-describedby="emailHelp">
                        {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('doi_tuong_ap_dung')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Nội dung chính sách</label>
                    <textarea id="ckeditor2" class="form-control" name="noi_dung" id=""></textarea>
                    @error('noi_dung')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_Admin_BE_Danh_Muc_Khoa_Hoc')}} ">Quay lại </a>
          
    </form>

    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor2');
    </script>
@endsection
