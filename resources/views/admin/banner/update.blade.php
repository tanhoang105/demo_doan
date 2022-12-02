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
                    <label for="" class="form-label">Ảnh Banner <span class="text-danger">*</span></label>
                    <input value="{{ old('anh_banner' ?? $banner->anh_banner) }}" type="file"
                           name="anh_banner" class="form-control" id="" aria-describedby="" onchange="loadFile(event)">
                    @error('anh_banner')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="{{ route('route_BE_Admin_Banner') }}"><button type="button" class="btn btn-danger">Hủy</button></a>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <img id="preview" src="{{ Storage::url($banner->anh_banner)  }}" style="width: 130px;height: 130px;">
                </div>
            </div>

        </div>
        

    </form>

    <script>
        var loadFile = function(event) {;
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
