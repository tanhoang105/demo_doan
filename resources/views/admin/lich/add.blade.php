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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Lich_Hoc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Ngày Học</label>
                    <input value="{{ old('ngay_hoc') ?? request()->ngay_hoc }}" type="date" name="ngay_hoc"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ngay_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Lớp học</label>
                    <select class="form-control" name="lop_id" id="">
                        @foreach ($lop as $item)
                            <option value=" {{ $item->id }} "> {{ $item->ten_lop }} </option>
                        @endforeach
                    </select>
                    @error('lop_id')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Thứ học</label>
                    <select class="form-control" name="ma_thu" id="">
                        @foreach ($thu as $item)
                            <option value=" {{ $item->ma_thu }} "> {{ $item->ten_thu }} </option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Ca Học</label>
                    <select class="form-control" name="ca_id" id="">
                        @foreach ($ca as $item)
                            <option value=" {{ $item->id }} ">
                                {{ $item->ca_hoc . ' ( ' . $item->thoi_gian_bat_dau . ' - ' . $item->thoi_gian_ket_thuc . ' )' }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('route_BE_Admin_List_Lich_Hoc') }}">
            <button type="button" class="btn btn-danger">Hủy</button></a>

    </form>
    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
