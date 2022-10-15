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
    <form class="p-5" action=" {{ route('route_Admin_BE_Update_Danh_Muc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên danh mục</label>
                    <input value="{{ $detail->ten_danh_muc ?? old('ten_danh_muc') }}" type="text"
                    
                        name="ten_danh_muc" class="form-control" id="chuyenBay" aria-describedby="">
                    @error('ten_danh_muc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
          
    </form>


@endsection
