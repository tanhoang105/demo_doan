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
    <form class="p-5" id="form" action=" {{ route('route_BE_Admin_Add_Dang_Ky') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
                <input class="signup-field" name="gia_khoa_hoc" id="gia_khoa_hoc" type="text" value="" hidden>
                <div class="mb-3">
                    <label for="" class="form-label">Tên </label>
                    <input class="form-control" value="" name="name" id="name" type="text" placeholder="Tên" required>
                    @error('name')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email </label>
                    <input class="form-control" value="" name="email" id="email" type="text" placeholder="Email" required>
                    <span class="msg_err_email"></span>
                    @error('email')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sđt </label>
                    <input class="form-control" value="" name="sdt" id="sdt" type="text" placeholder="Số điện thoại" required>
                    @error('sdt')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Địa chỉ </label>
                    <input class="form-control" value="" name="dia_chi" id="dia_chi" type="text" placeholder="Địa chỉ" required>
                    @error('dia_chi')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Khóa học </label>
                    <select class="form-control" name="id_khoa_hoc" id="id_khoa_hoc" data-url="{{route('admin_dang_ky')}}" required>
                        <option>-- Chọn khóa học --</option>
                            @foreach ($listKhoaHoc as $item)
                                <option  value="{{ $item->id }}">{{ $item->ten_khoa_hoc }}</option>
                            @endforeach
                    </select>
                    @error('id_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Lớp </label>
                    <select class="form-control" name="id_lop" id="id_lop" required>
                        <option>--Chọn Lớp--</option>
                    </select>
                    <span class="msg_err_lop"></span>

                    @error('id_lop')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Học phí</label>
                    <input class="form-control" name="" id="id_gia" type="text" value="" disabled>

                    @error('id_gia')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary btn-submit">Thêm</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_List_Dang_Ky')}} ">Quay lại </a>
       

    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $(document).on('change', '#id_khoa_hoc', function (event) {
                const url = $(this).data('url')
                const data = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        id_khoa_hoc: data
                    },
                    success: function (res) {
                        console.log(res)
                        let htmls="<option>--Chọn Lớp--</option>"
                        let ten_lop=Object.values(res.lop);
                        console.log(res.lop);
                        ten_lop.forEach(function (item) {
                            console.log(item)
                            htmls+=` <option  value="${ item.id }">${ item.ten_lop }</option>`
                        })
                        $('#id_gia').val(res.gia_khoa_hoc)
                        $('#gia_khoa_hoc').val(res.gia_khoa_hoc)
                        $('#id_lop').html(htmls)
                    }
                })
            })
        })
    </script>
@endsection
