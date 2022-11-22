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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Banner') }} " method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="" class="form-label">Ảnh Banner</label>
                    <input value="{{ old('anh_banner') ?? request()->anh_banner }}" type="file"
                           name="anh_banner" class="form-control" accept=".png, .jpg, .jpeg">
                    @error('anh_banner')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('route_BE_Admin_Banner') }}"><button type="button" class="btn btn-danger">Hủy</button></a>
    </form>

@endsection
