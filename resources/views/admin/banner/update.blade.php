@extends('Admin.templates.layout')
@section('content')

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Banner') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
                <div class="mb-3">
                    <label for="" class="form-label">Ảnh Banner</label>
                    <input id="hinhanh" value="{{ old('anh_banner') ?? $banner->anh_banner }}" type="file"
                           name="anh_banner" class="form-control" id="" aria-describedby="" onchange="loadFile(event)">
                    @error('anh_banner')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <img id="preview" style="border-radius: 100%;width:130px;height: 130px;" src="{{ Storage::url($banner->anh_banner)  }}">
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_Banner')}} ">Quay lại </a>
    </form>

    <script>
        var loadFile = function(event) {;
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
