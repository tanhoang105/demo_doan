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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Dang_Ky') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Lớp </label>
                    <select class="form-control" name="id_lop" id="">
                        @foreach ($lop as $item)
                            <option value="{{ $item->id }}"> {{ $item->ten_lop }} </option>
                        @endforeach

                    </select>
                  
                    @error('id_lop')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Học phí</label>
                    <input class="form-control" type="text" name="gia" id="">
                  
                    @error('id_lop')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Hình thức thanh toán </label>
                    <select class="form-control" name="id_lop" id="">
                        @foreach ($listthanhtoan as $item)
                            <option value="{{ $item->id }}"> {{ $item->ten }} </option>
                        @endforeach

                    </select>
                  
                    @error('id_lop')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

               

            </div>

        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>

    </form>
@endsection
